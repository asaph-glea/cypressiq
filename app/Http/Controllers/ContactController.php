<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMessage;
use App\Models\Booking;

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
        ]);

        ContactMessage::create($validated);

        return response()->json(['success' => true, 'message' => 'Thank you! Your message has been sent.']);
    }

    public function submitBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'preferred_time_slot' => 'required|string|max:255',
        ]);

        Booking::create($validated);

        return response()->json(['success' => true, 'message' => 'Your strategy session has been booked successfully!']);
    }
}
