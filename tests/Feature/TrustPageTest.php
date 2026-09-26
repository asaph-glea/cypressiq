<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\TrustSeeder;

class TrustPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_trust_page_renders_with_seeded_projects_testimonials_and_partnerships(): void
    {
        $this->seed(TrustSeeder::class);

        $response = $this->get('/trust');
        $response->assertStatus(200);

        // Assert Flagship Products are present as projects
        $response->assertSee('ITIKIA Campaign');
        $response->assertSee('OPERO');

        // Assert Real Client Projects & Testimonials
        $response->assertSee('PCEA Neema Church Nakuru');
        $response->assertSee('pceaneemanakuru.com');
        $response->assertSee('Amos Karoki');
        $response->assertSee('amoskaroki.com');

        // Assert Fictional Solutions / Projects & Testimonials
        $response->assertSee('ApexLogix');
        $response->assertSee('MedPulse');

        // Assert Strategic Partnerships
        $response->assertSee('Amazon Web Services (AWS)');
        $response->assertSee('Safaricom Telecommunications');
        $response->assertSee('Stripe Global Financial Infrastructure');
    }
}
