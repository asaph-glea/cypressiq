<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class CypressiqRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_core_pages_render_successfully(): void
    {
        $routes = [
            '/',
            // Products (CypressIQ's own software)
            '/opero',
            '/itikia',
            // Solutions (Technology built for clients)
            '/web-development',
            '/custom-software',
            '/business-systems',
            '/automation-integrations',
            '/digital-platforms',
            '/technology-consulting',
            // Work, Company & Tools
            '/portfolio',
            '/case-studies',
            '/trust',
            '/about',
            '/contact',
            '/tools',
            '/blog',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    public function test_legacy_route_redirects(): void
    {
        // Products redirects
        $this->get('/products/opero')->assertRedirect('/opero');
        $this->get('/products/itikia')->assertRedirect('/itikia');
        $this->get('/opero-erp')->assertRedirect('/opero');

        // Solutions redirects
        $this->get('/custom-technology')->assertRedirect('/custom-software');
        $this->get('/services')->assertRedirect('/custom-software');
        $this->get('/digital-transformation')->assertRedirect('/technology-consulting');
    }

    public function test_navigation_renders_distinct_products_and_solutions(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Our Software');
        $response->assertSee('Client Solutions');
        $response->assertSee(route('opero'));
        $response->assertSee(route('itikia'));
        $response->assertSee(route('solutions.web-development'));
        $response->assertSee(route('solutions.custom-software'));
        $response->assertSee(route('solutions.business-systems'));
        $response->assertSee(route('solutions.automation-integrations'));
        $response->assertSee(route('solutions.digital-platforms'));
        $response->assertSee(route('solutions.technology-consulting'));
        $response->assertSee(route('portfolio'));
        $response->assertSee(route('case-studies'));
    }

    public function test_redesigned_homepage_renders_all_nine_sections(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // 1. Hero
        $response->assertSee('Technology built around how', false);
        $response->assertSee('your organization works.', false);
        $response->assertSee('CypressIQ builds digital products, business systems and custom technology solutions', false);
        $response->assertSee('Explore our products');
        $response->assertSee('Build with CypressIQ');

        // 2. Introduction
        $response->assertSee('A Technology Company &amp; <span class="text-gradient">Software Product Builder</span>', false);
        $response->assertSee('We are not a marketing agency or a generalist dev shop');

        // 3. Products (ITIKIA & OPERO)
        $response->assertSee('ITIKIA');
        $response->assertSee('Digital Engagement &amp; Communication', false);
        $response->assertSee('OPERO');
        $response->assertSee('Business Operations &amp; Management', false);
        $response->assertSee(route('itikia'));
        $response->assertSee(route('opero'));

        // 4. Technology Solutions (6 capabilities)
        $response->assertSee('Custom Technology Built for <span class="text-gradient">Client Needs</span>', false);
        $response->assertSee(route('solutions.web-development'));
        $response->assertSee(route('solutions.custom-software'));
        $response->assertSee(route('solutions.business-systems'));
        $response->assertSee(route('solutions.automation-integrations'));
        $response->assertSee(route('solutions.digital-platforms'));
        $response->assertSee(route('solutions.technology-consulting'));

        // 5. How We Build (5-step process)
        $response->assertSee('How We Build: <span class="text-gradient">A Disciplined Process</span>', false);
        $response->assertSee('Understand');
        $response->assertSee('Design');
        $response->assertSee('Build');
        $response->assertSee('Deploy');
        $response->assertSee('Improve');

        // 6. Selected Work
        $response->assertSee('Selected Engineering <span class="text-gradient">Deliveries</span>', false);
        $response->assertSee('Regional Multi-Branch Retail Operations');
        $response->assertSee('High-Concurrency Public Engagement Hub');
        $response->assertSee('Automated Multi-Bank Reconciliation Engine');
        $response->assertSee('Fleet &amp; Dispatch Logistics Gateway', false);

        // 7. Technology / Capabilities
        $response->assertSee('Engineering Built for <span class="text-gradient">Operational Durability</span>', false);
        $response->assertSee('Relational Data Integrity');
        $response->assertSee('High-Concurrency Execution');
        $response->assertSee('Enterprise Security &amp; RBAC', false);
        $response->assertSee('Fault-Tolerant Integrations');
        $response->assertSee('Cloud DevOps &amp; Uptime', false);

        // 8. Insights
        $response->assertSee('Engineering &amp; <span class="text-gradient">Systems Insights</span>', false);

        // 9. Final CTA
        $response->assertSee('Build something with <span class="text-gradient">CypressIQ.</span>', false);
    }

    public function test_blog_post_detail_renders_dynamically(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Technology', 'slug' => 'technology']);

        $post = Post::create([
            'title' => 'Scaling Distributed Architecture Across East Africa',
            'slug' => 'scaling-distributed-architecture',
            'excerpt' => 'A guide to resilient systems.',
            'content' => '<h2>Resilience</h2><p>Engineering for high concurrency and low latency.</p>',
            'status' => 'published',
            'author_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $response = $this->get('/blog/' . $post->slug);
        $response->assertStatus(200);
        $response->assertSee('Scaling Distributed Architecture Across East Africa');
    }

    public function test_lead_capture_endpoint(): void
    {
        $response = $this->postJson('/lead-capture', [
            'email' => 'architect@cypressiq.com',
            'source' => 'test_suite',
            'type' => 'automated_test'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $lead = \App\Models\Lead::latest('id')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('architect@cypressiq.com', $lead->email);
        $this->assertEquals('test_suite', $lead->source);
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->postJson('/contact-submit', [
            'first_name' => 'Architecture',
            'last_name' => 'Tester',
            'email' => 'contact-test@cypressiq.com',
            'phone' => '+254700000000',
            'service_interest' => 'Opero ERP',
            'budget_range' => 'Immediate (< 30 days)',
            'message' => 'Automated integration test message'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('contact_messages', ['email' => 'contact-test@cypressiq.com']);
    }

    public function test_booking_form_submission(): void
    {
        $response = $this->postJson('/booking-submit', [
            'name' => 'System Architect Tester',
            'email' => 'architect@cypressiq.com',
            'phone' => '+254700000000',
            'preferred_time_slot' => 'Mon 10:00 AM EAT'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('bookings', ['email' => 'architect@cypressiq.com']);
    }

    public function test_dedicated_product_pages_render_mockups_and_modules(): void
    {
        // Test OPERO dedicated page
        $opero = $this->get('/opero');
        $opero->assertStatus(200);
        $opero->assertSee('OPERO: The Business Operations');
        $opero->assertSee('Point of Sale (POS) Terminal');
        $opero->assertSee('Multi-Warehouse Inventory');
        $opero->assertSee('Double-Entry Operational Ledger');
        $opero->assertSee('Strict Departmental');

        // Test ITIKIA dedicated page
        $itikia = $this->get('/itikia');
        $itikia->assertStatus(200);
        $itikia->assertSee('ITIKIA: Digital Engagement');
        $itikia->assertSee('AMANI KENYA');
        $itikia->assertSee('Policy Manifestos Matrix');
        $itikia->assertSee('Grassroots Volunteer Mobilization');
        $itikia->assertSee('33-Point Readiness');
    }

    public function test_project_discovery_system_submission_creates_lead_and_message(): void
    {
        $response = $this->postJson('/contact-submit', [
            'first_name' => 'Wanjiku',
            'last_name' => 'Njeri',
            'email' => 'wanjiku@enterprise.co.ke',
            'phone' => '+254711223344',
            'service_interest' => 'Business Operations (Opero ERP)',
            'message' => '[Operational Scale: Multi-Branch (2-10 Outlets)] We need real-time multi-warehouse inventory',
            'source' => 'project_discovery_engine'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verifies both ContactMessage and Lead are registered in unified pipeline
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'wanjiku@enterprise.co.ke',
            'source' => 'project_discovery_engine'
        ]);
        $lead = \App\Models\Lead::where('source', 'project_discovery_engine')->latest('id')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('wanjiku@enterprise.co.ke', $lead->email);
    }
}
