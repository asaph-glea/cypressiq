<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\LeadAlertMail;
use App\Models\Lead;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\User;
use App\Services\LeadAlertService;

class LeadAlertSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_dispatches_email_and_creates_lead(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact-submit', [
            'first_name'       => 'James',
            'last_name'        => 'Mwangi',
            'email'            => 'james@enterprise.ke',
            'phone'            => '+254712345678',
            'service_interest' => 'Opero ERP System',
            'budget_range'     => 'Immediate (< 30 days)',
            'message'          => 'Require multi-branch retail POS with offline sync for 8 locations.',
            'source'           => 'contact_page',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verify Lead created with intelligence
        $lead = Lead::where('email', 'james@enterprise.ke')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('James Mwangi', $lead->name);
        $this->assertEquals('opero', $lead->product_interest);
        $this->assertEquals('high', $lead->priority);

        // Verify Mailable sent
        Mail::assertSent(LeadAlertMail::class, function ($mail) {
            return $mail->type === 'inquiry' &&
                   $mail->payload['email'] === 'james@enterprise.ke' &&
                   $mail->priority === 'high';
        });
    }

    public function test_strategy_booking_submission_dispatches_urgent_alert(): void
    {
        Mail::fake();

        $response = $this->postJson('/booking-submit', [
            'name'                => 'Eunice Wambui',
            'email'               => 'eunice@fintech.co',
            'phone'               => '+254799887766',
            'preferred_time_slot' => 'Thursday, 2:00 PM EAT',
            'source'              => 'strategy_scheduler',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verify Booking created
        $booking = Booking::where('email', 'eunice@fintech.co')->first();
        $this->assertNotNull($booking);
        $this->assertEquals('Thursday, 2:00 PM EAT', $booking->preferred_time_slot);

        // Verify urgent lead created
        $lead = Lead::where('email', 'eunice@fintech.co')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('urgent', $lead->priority);

        // Verify Mailable sent
        Mail::assertSent(LeadAlertMail::class, function ($mail) {
            return $mail->type === 'booking' &&
                   $mail->priority === 'urgent';
        });
    }

    public function test_radar_identifies_overdue_leads_and_urgent_items(): void
    {
        // 1. Create a lead older than 24 hours
        $lead = Lead::create([
            'email'            => 'overdue@corp.com',
            'name'             => 'Overdue Client',
            'product_interest' => 'opero',
            'status'           => 'new',
            'priority'         => 'high',
        ]);
        $lead->timestamps = false;
        $lead->created_at = now()->subHours(28);
        $lead->save();

        // 2. Create an urgent lead older than 2 hours
        $urgentLead = Lead::create([
            'email'            => 'urgent@client.com',
            'name'             => 'Urgent Prospect',
            'product_interest' => 'itikia',
            'status'           => 'new',
            'priority'         => 'urgent',
        ]);
        $urgentLead->timestamps = false;
        $urgentLead->created_at = now()->subHours(4);
        $urgentLead->save();

        $radar = LeadAlertService::getRadarData();

        $this->assertEquals(1, $radar['total_overdue']);
        $this->assertEquals(1, $radar['total_urgent']);
        $this->assertEquals('Overdue Client', $radar['overdue_leads'][0]['name']);
        $this->assertEquals(28, $radar['overdue_leads'][0]['hours_waiting']);
        $this->assertEquals('Urgent Prospect', $radar['urgent_leads'][0]['name']);
        $this->assertEquals(4, $radar['urgent_leads'][0]['hours_waiting']);
    }

    public function test_admin_dashboard_renders_radar_widget(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Inbound Action Radar &amp; Follow-Up SLA Tracker', false);
        $response->assertSee('Test Chime', false);
        $response->assertSee('Push Alerts', false);
    }
}
