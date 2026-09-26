<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;
use App\Models\Booking;
use App\Models\Lead;
use App\Models\ContactSetting;

class ContactController extends Controller
{
    public function submitMessage(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_interest' => 'required|string|max:255',
            'budget_range' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'source' => 'nullable|string|max:255',
        ]);

        $source = $validated['source'] ?? 'website_contact';
        $fullName = trim("{$validated['first_name']} {$validated['last_name']}");

        // Detect product interest
        $serviceLower = strtolower($validated['service_interest'] ?? '');
        $productInterest = 'solutions';
        if (str_contains($serviceLower, 'itikia')) {
            $productInterest = 'itikia';
        } elseif (str_contains($serviceLower, 'opero')) {
            $productInterest = 'opero';
        } elseif (str_contains($serviceLower, 'consult')) {
            $productInterest = 'consulting';
        }

        // Parse scale if present in message
        $projectScale = null;
        if (preg_match('/\[Operational Scale:\s*([^\]]+)\]/i', $validated['message'] ?? '', $matches)) {
            $projectScale = trim($matches[1]);
        }

        $contactMessage = ContactMessage::create(array_merge($validated, [
            'source' => $source,
            'status' => 'new'
        ]));

        // Seamlessly route into the active Lead Pipeline with intelligence fields
        Lead::create([
            'email'            => $validated['email'],
            'name'             => $fullName,
            'phone'            => $validated['phone'] ?? null,
            'source'           => $source,
            'type'             => $validated['service_interest'],
            'project_type'     => $validated['service_interest'],
            'project_scale'    => $projectScale,
            'timeline'         => $validated['budget_range'] ?? null,
            'message'          => $validated['message'] ?? null,
            'product_interest' => $productInterest,
            'status'           => 'new',
            'priority'         => (str_contains(strtolower($validated['budget_range'] ?? ''), 'immediate') || str_contains($serviceLower, 'opero')) ? 'high' : 'medium',
        ]);

        $priority = (str_contains(strtolower($validated['budget_range'] ?? ''), 'immediate') || str_contains($serviceLower, 'opero')) ? 'high' : 'medium';

        // Dispatch immediate admin notification / telemetry event
        $this->notifyLeadCapture('inquiry', [
            'name'    => $fullName,
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'service' => $validated['service_interest'],
            'budget'  => $validated['budget_range'] ?? null,
            'source'  => $source,
            'message' => $validated['message'] ?? null,
        ], $priority);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your project inquiry has been received. Our engineering team will review your specifications and follow up within 24 hours.'
        ]);
    }

    public function submitBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'preferred_time_slot' => 'required|string|max:255',
            'source' => 'nullable|string|max:255',
        ]);

        $source = $validated['source'] ?? 'consultation_scheduler';
        $booking = Booking::create(array_merge($validated, [
            'status' => 'confirmed'
        ]));

        // Register into active Lead Pipeline
        Lead::create([
            'email'            => $validated['email'],
            'name'             => $validated['name'],
            'phone'            => $validated['phone'] ?? null,
            'source'           => $source,
            'type'             => 'consultation_booking',
            'timeline'         => $validated['preferred_time_slot'],
            'message'          => "Consultation booked for slot: {$validated['preferred_time_slot']}",
            'product_interest' => 'consulting',
            'status'           => 'qualified',
            'priority'         => 'urgent',
        ]);

        // Dispatch immediate admin notification
        $this->notifyLeadCapture('booking', [
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'phone'  => $validated['phone'] ?? null,
            'slot'   => $validated['preferred_time_slot'],
            'source' => $source,
        ], 'urgent');

        return response()->json([
            'success' => true,
            'message' => 'Your consultation session has been booked successfully! A calendar invite and meeting details will follow shortly.'
        ]);
    }

    public function submitLead(Request $request)
    {
        $validated = $request->validate([
            'email'  => 'required|email|max:255',
            'source' => 'nullable|string|max:255',
            'type'   => 'nullable|string|max:255',
        ]);

        $lead = Lead::create([
            'email'  => $validated['email'],
            'source' => $validated['source'] ?? 'website',
            'type'   => $validated['type'] ?? 'inquiry',
        ]);

        $this->notifyLeadCapture('lead', [
            'email'  => $validated['email'],
            'source' => $validated['source'] ?? 'website',
            'type'   => $validated['type'] ?? 'inquiry',
        ], 'medium');

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your interest. We will be in touch shortly.'
        ]);
    }

    /**
     * Dispatch notification to admin notification pipeline / webhook / email
     */
    protected function notifyLeadCapture(string $eventType, array $payload, string $priority = 'medium'): void
    {
        \App\Services\LeadAlertService::dispatchAlert($eventType, $payload, $priority);
    }
}

