<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactMessage;
use App\Models\Booking;
use App\Models\ContactSetting;

class LeadManagementController extends Controller
{
    public function getSettings()
    {
        return response()->json(ContactSetting::firstOrCreate(['id' => 1]));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'company_email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'google_map_embed' => 'nullable|string',
        ]);

        $settings = ContactSetting::firstOrCreate(['id' => 1]);
        $settings->update($validated);

        return response()->json(['success' => true]);
    }

    public function getMessages()
    {
        return response()->json(ContactMessage::latest()->get());
    }

    public function updateMessageStatus(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function getBookings()
    {
        return response()->json(Booking::latest()->get());
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }
}
