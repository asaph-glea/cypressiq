<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\ProductVideo;

class CypressiqProductVideoTest extends TestCase
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

    public function test_unauthenticated_users_cannot_access_product_video_api(): void
    {
        $this->getJson('/admin/api/product-videos')
            ->assertStatus(401);

        $this->postJson('/admin/api/product-videos/opero', [
            'title' => 'Unauthorized Attempt',
        ])->assertStatus(401);
    }

    public function test_admin_can_retrieve_product_videos(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->getJson('/admin/api/product-videos');

        $response->assertStatus(200)
            ->assertJson([
                'success' => 1,
            ])
            ->assertJsonStructure([
                'success',
                'videos' => [
                    'opero',
                    'itikia',
                    'solutions',
                ],
            ]);
    }

    public function test_admin_can_update_product_video_metadata_and_url(): void
    {
        $payload = [
            'title'       => 'OPERO — 2026 NextGen Enterprise ERP',
            'subtitle'    => 'Biometric HR, Multi-Branch Stock & POS',
            'video_url'   => 'https://cdn.cypressiq.app/videos/opero-v2.mp4',
            'poster_url'  => 'https://cdn.cypressiq.app/posters/opero-v2.webp',
        ];

        $response = $this->actingAs($this->adminUser)
            ->postJson('/admin/api/product-videos/opero', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => 1,
                'video'   => [
                    'product_key' => 'opero',
                    'title'       => 'OPERO — 2026 NextGen Enterprise ERP',
                    'video_url'   => 'https://cdn.cypressiq.app/videos/opero-v2.mp4',
                ],
            ]);

        $this->assertDatabaseHas('product_videos', [
            'product_key' => 'opero',
            'title'       => 'OPERO — 2026 NextGen Enterprise ERP',
            'video_url'   => 'https://cdn.cypressiq.app/videos/opero-v2.mp4',
        ]);
    }

    public function test_admin_can_upload_product_video_and_poster_files(): void
    {
        Storage::fake('public');

        $videoFile = UploadedFile::fake()->create('custom-itikia.mp4', 1024, 'video/mp4');
        $posterFile = UploadedFile::fake()->image('custom-itikia-poster.webp', 1280, 800);

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/api/product-videos/itikia', [
                'title'       => 'ITIKIA — Mobilization Hub Walkthrough',
                'video_file'  => $videoFile,
                'poster_file' => $posterFile,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => 1,
            ]);

        $updated = ProductVideo::where('product_key', 'itikia')->first();
        $this->assertNotNull($updated);
        $this->assertStringContainsString('itikia-walkthrough-', $updated->video_url);
        $this->assertStringContainsString('itikia-poster-', $updated->poster_url);
    }

    public function test_opero_page_renders_video_modal_and_trigger_button(): void
    {
        $response = $this->get('/opero');

        $response->assertStatus(200);
        $response->assertSee('Review System Modules 🎥');
        $response->assertSee("openProductVideoModal('opero')", false);
        $response->assertSee('product-video-modal', false);
    }

    public function test_itikia_page_renders_video_modal_and_trigger_button(): void
    {
        $response = $this->get('/itikia');

        $response->assertStatus(200);
        $response->assertSee('Review System Modules 🎥');
        $response->assertSee("openProductVideoModal('itikia')", false);
        $response->assertSee('product-video-modal', false);
    }

    public function test_custom_software_solutions_page_renders_video_modal(): void
    {
        $response = $this->get('/custom-software');

        $response->assertStatus(200);
        $response->assertSee('Review Systems Walkthrough 🎥');
        $response->assertSee("openProductVideoModal('solutions')", false);
        $response->assertSee('product-video-modal', false);
    }

    public function test_homepage_renders_product_video_modal_and_dynamic_loopers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('product-video-modal', false);
        $response->assertSee("openProductVideoModal('itikia')", false);
        $response->assertSee("openProductVideoModal('opero')", false);
        $response->assertSee("openProductVideoModal('solutions')", false);
    }

    public function test_admin_dashboard_renders_product_videos_panel(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('panel-videos', false);
        $response->assertSee('Product Video Walkthroughs &amp; Media Manager', false);
        $response->assertSee('OPERO Business ERP');
        $response->assertSee('ITIKIA Movement Engine');
        $response->assertSee('Custom Digital Solutions');
    }
}
