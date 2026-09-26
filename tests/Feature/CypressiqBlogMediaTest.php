<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class CypressiqBlogMediaTest extends TestCase
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

    public function test_admin_can_update_existing_post(): void
    {
        $category = Category::create([
            'name' => 'Systems Architecture',
            'slug' => 'systems-architecture',
        ]);

        $post = Post::create([
            'title' => 'Original Draft Post',
            'slug' => 'original-draft-post',
            'content' => '<p>Initial content</p>',
            'excerpt' => 'Initial excerpt',
            'status' => 'draft',
            'author_id' => $this->adminUser->id,
            'category_id' => $category->id,
        ]);

        $updatePayload = [
            'title' => 'Updated Distributed Systems Blueprint',
            'slug' => 'updated-distributed-systems-blueprint',
            'content' => '<p>Updated content with architecture breakdown.</p>',
            'excerpt' => 'Updated excerpt for client reading',
            'status' => 'published',
            'category_id' => $category->id,
            'featured_image' => '/storage/uploads/cover-test.webp',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ];

        $response = $this->actingAs($this->adminUser)->putJson("/admin/api/posts/{$post->id}", $updatePayload);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $post->refresh();
        $this->assertEquals('Updated Distributed Systems Blueprint', $post->title);
        $this->assertEquals('published', $post->status);
        $this->assertEquals('/storage/uploads/cover-test.webp', $post->featured_image);
        $this->assertEquals('https://www.youtube.com/watch?v=dQw4w9WgXcQ', $post->video_url);
    }

    public function test_post_creation_supports_featured_image_and_video_url(): void
    {
        $category = Category::create([
            'name' => 'Proprietary Software',
            'slug' => 'proprietary-software',
        ]);

        $createPayload = [
            'title' => 'Inside Opero POS Terminal Architecture',
            'slug' => 'inside-opero-pos-terminal-architecture',
            'content' => '<p>Deep dive into high-availability offline sync.</p>',
            'excerpt' => 'How Opero handles offline sales resilience',
            'status' => 'published',
            'category_id' => $category->id,
            'featured_image' => '/storage/uploads/opero-hero.png',
            'video_url' => 'https://vimeo.com/76979871',
        ];

        $response = $this->actingAs($this->adminUser)->postJson('/admin/api/posts', $createPayload);

        $response->assertStatus(201);
        $response->assertJson(['success' => true]);

        $post = Post::where('slug', 'inside-opero-pos-terminal-architecture')->first();
        $this->assertNotNull($post);
        $this->assertEquals('/storage/uploads/opero-hero.png', $post->featured_image);
        $this->assertEquals('https://vimeo.com/76979871', $post->video_url);
    }

    public function test_media_upload_accepts_images_and_videos(): void
    {
        Storage::fake('public');

        // 1. Test image upload
        $imageFile = UploadedFile::fake()->image('diagram.png', 800, 600);
        $imageResponse = $this->actingAs($this->adminUser)->postJson('/admin/api/upload', [
            'file' => $imageFile
        ]);

        $imageResponse->assertStatus(200);
        $imageResponse->assertJson(['success' => 1, 'type' => 'image']);
        $this->assertNotNull($imageResponse->json('url'));

        // 2. Test video upload (MP4)
        $videoFile = UploadedFile::fake()->create('demo.mp4', 1024, 'video/mp4');
        $videoResponse = $this->actingAs($this->adminUser)->postJson('/admin/api/upload', [
            'file' => $videoFile
        ]);

        $videoResponse->assertStatus(200);
        $videoResponse->assertJson(['success' => 1, 'type' => 'video']);
        $this->assertNotNull($videoResponse->json('url'));
    }

    public function test_blog_show_page_renders_video_embeds_and_images(): void
    {
        $category = Category::create([
            'name' => 'Technical Insights',
            'slug' => 'technical-insights',
        ]);

        $post = Post::create([
            'title' => 'Engineering High Availability for African Enterprises',
            'slug' => 'engineering-high-availability-for-african-enterprises',
            'content' => '
                <p>Welcome to our tech breakdown.</p>
                <figure>
                    <img src="/storage/uploads/architecture-chart.svg" alt="Distributed Cloud" />
                    <figcaption>Figure 1: Cross-region replication topology</figcaption>
                </figure>
                <div class="video-container">
                    <iframe src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                </div>
                <video controls preload="metadata">
                    <source src="/storage/uploads/pos-demo.mp4" type="video/mp4">
                </video>
            ',
            'excerpt' => 'How we architect for 99.99% operational durability.',
            'status' => 'published',
            'author_id' => $this->adminUser->id,
            'category_id' => $category->id,
            'featured_image' => '/storage/uploads/featured-cover.webp',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $response = $this->get('/blog/' . $post->slug);
        $response->assertStatus(200);

        // Verify responsive featured video embed
        $response->assertSee('featured-video-container');
        $response->assertSee('youtube-nocookie.com/embed/dQw4w9WgXcQ');

        // Verify body embedded image
        $response->assertSee('/storage/uploads/architecture-chart.svg');
        $response->assertSee('Figure 1: Cross-region replication topology');

        // Verify body embedded video
        $response->assertSee('/storage/uploads/pos-demo.mp4');
    }
}
