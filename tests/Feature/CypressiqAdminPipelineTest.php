<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Lead;
use App\Models\ContactMessage;

class CypressiqAdminPipelineTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_admin_dashboard_renders_with_sales_cockpit_metrics(): void
    {
        Lead::create([
            'email' => 'tech@lead.com',
            'name' => 'Alice Dev',
            'product_interest' => 'itikia',
            'status' => 'new',
            'priority' => 'high'
        ]);

        Lead::create([
            'email' => 'ops@company.com',
            'name' => 'Bob Manager',
            'product_interest' => 'opero',
            'status' => 'qualified',
            'priority' => 'urgent'
        ]);

        $response = $this->actingAs($this->adminUser)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Command Center');
        $response->assertSee('Sales Pipeline');
        $response->assertSee('ITIKIA');
        $response->assertSee('OPERO');
    }

    public function test_leads_api_filters_by_product_and_stage(): void
    {
        Lead::create([
            'email' => 'itikia@client.com',
            'name' => 'Campaign Lead',
            'product_interest' => 'itikia',
            'status' => 'new',
            'priority' => 'high'
        ]);

        Lead::create([
            'email' => 'opero@client.com',
            'name' => 'ERP Lead',
            'product_interest' => 'opero',
            'status' => 'qualified',
            'priority' => 'urgent'
        ]);

        // Filter by ITIKIA
        $response = $this->actingAs($this->adminUser)->getJson('/admin/api/leads?product_interest=itikia');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['email' => 'itikia@client.com']);

        // Filter by status=qualified
        $response = $this->actingAs($this->adminUser)->getJson('/admin/api/leads?status=qualified');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['email' => 'opero@client.com']);
    }

    public function test_lead_inline_status_transition(): void
    {
        $lead = Lead::create([
            'email' => 'transition@client.com',
            'name' => 'Testing Lifecycle',
            'status' => 'new'
        ]);

        $response = $this->actingAs($this->adminUser)->putJson("/admin/api/leads/{$lead->id}/status", [
            'status' => 'qualified'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $lead->refresh();
        $this->assertEquals('qualified', $lead->status);
        $this->assertNotNull($lead->last_contacted_at);
    }

    public function test_lead_priority_update(): void
    {
        $lead = Lead::create([
            'email' => 'priority@client.com',
            'priority' => 'medium'
        ]);

        $response = $this->actingAs($this->adminUser)->putJson("/admin/api/leads/{$lead->id}/priority", [
            'priority' => 'urgent'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $lead->refresh();
        $this->assertEquals('urgent', $lead->priority);
    }

    public function test_lead_note_appending(): void
    {
        $lead = Lead::create([
            'email' => 'notes@client.com',
            'name' => 'Note Prospect'
        ]);

        $response = $this->actingAs($this->adminUser)->postJson("/admin/api/leads/{$lead->id}/notes", [
            'note' => 'Spoke with CTO; scheduled architecture review.'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $lead->refresh();
        $this->assertStringContainsString('Spoke with CTO', $lead->notes);
    }

    public function test_discovery_intake_populates_rich_lead_specifications(): void
    {
        $response = $this->postJson('/contact-submit', [
            'first_name' => 'Njoroge',
            'last_name' => 'Kimani',
            'email' => 'njoroge@fintech.co.ke',
            'phone' => '+254700112233',
            'service_interest' => 'Opero ERP System',
            'budget_range' => 'Immediate (< 30 days)',
            'message' => '[Operational Scale: 5 Branches] Need multi-currency accounting and real-time inventory.',
            'source' => 'project_discovery_engine'
        ]);

        $response->assertStatus(200);

        $lead = Lead::where('email', 'njoroge@fintech.co.ke')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('Njoroge Kimani', $lead->name);
        $this->assertEquals('+254700112233', $lead->phone);
        $this->assertEquals('opero', $lead->product_interest);
        $this->assertEquals('5 Branches', $lead->project_scale);
        $this->assertEquals('high', $lead->priority);
        $this->assertEquals('new', $lead->status);
    }

    public function test_unauthenticated_user_accessing_admin_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');

        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(302);
        $loginResponse->assertRedirect('/admin/login');

        $adminLoginResponse = $this->get('/admin/login');
        $adminLoginResponse->assertStatus(200);
        $adminLoginResponse->assertSee('Admin Login');
    }

    public function test_radar_api_detects_overdue_leads_and_pending_bookings(): void
    {
        // 1. Create an overdue lead (> 24 hours)
        $lead = Lead::create([
            'email' => 'overdue@client.com',
            'name' => 'Overdue Prospect',
            'product_interest' => 'opero',
            'status' => 'new',
            'priority' => 'high',
        ]);
        $lead->timestamps = false;
        $lead->created_at = now()->subHours(26);
        $lead->save();

        // 2. Create a pending booking
        \App\Models\Booking::create([
            'name' => 'Sarah Call',
            'email' => 'sarah@call.com',
            'phone' => '+254711223344',
            'preferred_time_slot' => 'Tomorrow 10:00 AM',
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($this->adminUser)->getJson('/admin/api/radar');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'total_overdue',
            'total_urgent',
            'total_pending',
            'overdue_leads',
            'urgent_leads',
            'pending_bookings',
            'latest_lead_id',
        ]);

        $this->assertEquals(1, $response->json('total_overdue'));
        $this->assertEquals(1, $response->json('total_pending'));
        $this->assertEquals('Overdue Prospect', $response->json('overdue_leads.0.name'));
    }
}
