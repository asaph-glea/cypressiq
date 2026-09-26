<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Lead;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CypressiqSecurityAndRbacTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;
    protected User $growthUser;
    protected User $engineerUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create([
            'name'      => 'Executive Admin',
            'email'     => 'admin@cypressiq.agency',
            'role'      => User::ROLE_SUPER_ADMIN,
            'is_admin'  => true,
            'is_active' => true,
        ]);

        $this->growthUser = User::factory()->create([
            'name'      => 'Sarah Marketer',
            'email'     => 'growth@cypressiq.agency',
            'role'      => User::ROLE_GROWTH,
            'is_admin'  => true,
            'is_active' => true,
        ]);

        $this->engineerUser = User::factory()->create([
            'name'      => 'David Engineer',
            'email'     => 'engineer@cypressiq.agency',
            'role'      => User::ROLE_PRODUCT_ENGINEER,
            'is_admin'  => true,
            'is_active' => true,
        ]);
    }

    public function test_super_admin_has_full_governance_and_access(): void
    {
        $response = $this->actingAs($this->superAdmin)->getJson('/admin/api/users');
        $response->assertStatus(200)
            ->assertJsonPath('success', 1)
            ->assertJsonCount(3, 'users');

        $auditResponse = $this->actingAs($this->superAdmin)->getJson('/admin/api/audit-logs');
        $auditResponse->assertStatus(200)
            ->assertJsonPath('success', 1);
    }

    public function test_growth_role_can_manage_pipeline_and_posts(): void
    {
        $lead = Lead::create([
            'email'            => 'prospect@acme.com',
            'name'             => 'Acme Prospect',
            'product_interest' => 'itikia',
            'status'           => 'new',
            'priority'         => 'urgent',
        ]);

        $statusResp = $this->actingAs($this->growthUser)->putJson("/admin/api/leads/{$lead->id}/status", [
            'status' => 'qualified',
        ]);
        $statusResp->assertStatus(200);
        $this->assertDatabaseHas('leads', ['id' => $lead->id, 'status' => 'qualified']);

        // Check that lead mutation wrote an ActivityLog entry
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'lead.stage_update',
            'user_id' => $this->growthUser->id,
        ]);

        // Growth user creates a post
        $postResp = $this->actingAs($this->growthUser)->postJson('/admin/api/posts', [
            'title'        => 'Growth Strategy Insights 2026',
            'slug'         => 'growth-strategy-insights-2026',
            'content'      => 'Deep dive into digital execution and market expansion.',
            'status'       => 'published',
        ]);
        $postResp->assertStatus(201);
        $this->assertDatabaseHas('posts', ['slug' => 'growth-strategy-insights-2026']);
    }

    public function test_growth_role_is_forbidden_from_engineering_and_superadmin_apis(): void
    {
        // Growth user tries to update product videos -> 403 Forbidden
        $videoResp = $this->actingAs($this->growthUser)->postJson('/admin/api/product-videos/opero', [
            'title'     => 'Hacked Title',
            'video_url' => 'https://youtube.com/watch?v=123',
        ]);
        $videoResp->assertStatus(403);

        // Verify violation was recorded in audit log
        $this->assertDatabaseHas('activity_logs', [
            'action'  => 'security.unauthorized_attempt',
            'user_id' => $this->growthUser->id,
        ]);

        // Growth user tries to view team or audit logs -> 403 Forbidden
        $usersResp = $this->actingAs($this->growthUser)->getJson('/admin/api/users');
        $usersResp->assertStatus(403);

        $auditResp = $this->actingAs($this->growthUser)->getJson('/admin/api/audit-logs');
        $auditResp->assertStatus(403);
    }

    public function test_product_engineer_role_can_manage_product_videos_but_forbidden_from_sales(): void
    {
        // Engineer can update product video
        $videoResp = $this->actingAs($this->engineerUser)->postJson('/admin/api/product-videos/itikia', [
            'title'       => 'ITIKIA Civic Walkthrough v2',
            'description' => 'Updated walkthrough of real-time polling.',
            'video_url'   => 'https://youtube.com/watch?v=itikia99',
            'platform'    => 'youtube',
        ]);
        $videoResp->assertStatus(200);

        $this->assertDatabaseHas('activity_logs', [
            'action'  => 'video.updated',
            'user_id' => $this->engineerUser->id,
        ]);

        // Engineer cannot mutate lead stage -> 403 Forbidden
        $lead = Lead::create([
            'email'    => 'client@ops.com',
            'name'     => 'Client Ops',
            'status'   => 'new',
            'priority' => 'high',
        ]);

        $leadResp = $this->actingAs($this->engineerUser)->putJson("/admin/api/leads/{$lead->id}/status", [
            'status' => 'won',
        ]);
        $leadResp->assertStatus(403);

        // Engineer cannot create blog post -> 403 Forbidden
        $postResp = $this->actingAs($this->engineerUser)->postJson('/admin/api/posts', [
            'title'   => 'Engineering Note',
            'content' => 'Forbidden post',
            'status'  => 'draft',
        ]);
        $postResp->assertStatus(403);
    }

    public function test_suspended_user_cannot_authenticate(): void
    {
        $suspendedUser = User::factory()->create([
            'email'     => 'suspended@cypressiq.agency',
            'password'  => Hash::make('secret1234'),
            'role'      => User::ROLE_GROWTH,
            'is_active' => false,
            'is_admin'  => true,
        ]);

        $response = $this->post('/admin/login', [
            'email'    => 'suspended@cypressiq.agency',
            'password' => 'secret1234',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');

        // Audit log tracks the deactivated login attempt
        $this->assertDatabaseHas('activity_logs', [
            'action'     => 'auth.deactivated_attempt',
            'user_email' => 'suspended@cypressiq.agency',
        ]);
    }

    public function test_ensure_role_middleware_terminates_session_if_user_is_deactivated(): void
    {
        $user = User::factory()->create([
            'role'      => User::ROLE_GROWTH,
            'is_active' => true,
            'is_admin'  => true,
        ]);

        // Deactivate user in database while session is active
        $user->is_active = false;
        $user->save();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_super_admin_cannot_deactivate_own_account(): void
    {
        $response = $this->actingAs($this->superAdmin)->postJson("/admin/api/users/{$this->superAdmin->id}/toggle-status");
        $response->assertStatus(422)
            ->assertJsonPath('success', 0)
            ->assertJsonPath('message', 'You cannot deactivate your own account.');

        $this->superAdmin->refresh();
        $this->assertTrue((bool) $this->superAdmin->is_active);
    }

    public function test_super_admin_can_create_new_team_member_and_suspend_them(): void
    {
        $createResp = $this->actingAs($this->superAdmin)->postJson('/admin/api/users', [
            'name'     => 'Mark Product Lead',
            'email'    => 'mark@cypressiq.agency',
            'role'     => User::ROLE_PRODUCT_ENGINEER,
            'password' => 'supersecurepassword99',
        ]);

        $createResp->assertStatus(200)->assertJsonPath('success', 1);

        $created = User::where('email', 'mark@cypressiq.agency')->first();
        $this->assertNotNull($created);
        $this->assertEquals(User::ROLE_PRODUCT_ENGINEER, $created->role);
        $this->assertTrue((bool) $created->is_active);

        // Audit log recorded
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'user.created',
            'user_id' => $this->superAdmin->id,
        ]);

        // Now toggle status (suspend)
        $toggleResp = $this->actingAs($this->superAdmin)->postJson("/admin/api/users/{$created->id}/toggle-status");
        $toggleResp->assertStatus(200)->assertJsonPath('is_active', false);

        $created->refresh();
        $this->assertFalse((bool) $created->is_active);

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'user.status_toggled',
        ]);
    }

    public function test_successful_login_updates_security_metadata_and_logs_audit(): void
    {
        $user = User::factory()->create([
            'email'     => 'active@cypressiq.agency',
            'password'  => Hash::make('passphrase1234'),
            'role'      => User::ROLE_GROWTH,
            'is_active' => true,
            'is_admin'  => true,
        ]);

        $response = $this->post('/admin/login', [
            'email'    => 'active@cypressiq.agency',
            'password' => 'passphrase1234',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);

        $user->refresh();
        $this->assertNotNull($user->last_login_at);

        $this->assertDatabaseHas('activity_logs', [
            'action'  => 'auth.login',
            'user_id' => $user->id,
        ]);
    }
}
