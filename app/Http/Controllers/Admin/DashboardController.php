<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Lead;
use App\Models\ContactMessage;
use App\Models\Booking;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Schema::hasTable('posts') ? Post::latest()->get() : collect();
        $leads = Schema::hasTable('leads') ? Lead::latest()->get() : collect();
        $messages = Schema::hasTable('contact_messages') ? ContactMessage::latest()->take(10)->get() : collect();
        $bookings = Schema::hasTable('bookings') ? Booking::latest()->take(10)->get() : collect();
        $categories = Schema::hasTable('categories') ? \App\Models\Category::all() : collect();

        $stats = [
            'total_posts' => Schema::hasTable('posts') ? Post::count() : 0,
            'published_posts' => Schema::hasTable('posts') ? Post::where('status', 'published')->count() : 0,
            'draft_posts' => Schema::hasTable('posts') ? Post::where('status', 'draft')->count() : 0,
            'scheduled_posts' => Schema::hasTable('posts') ? Post::where('status', 'scheduled')->count() : 0,
            'total_leads' => Schema::hasTable('leads') ? Lead::count() : 0,
            'new_leads_this_week' => Schema::hasTable('leads') ? Lead::where('created_at', '>=', now()->subDays(7))->count() : 0,
            'active_pipeline' => Schema::hasTable('leads') ? Lead::whereIn('status', ['new', 'reviewed', 'qualified', 'proposal'])->count() : 0,
            'itikia_leads' => Schema::hasTable('leads') ? Lead::where('product_interest', 'itikia')->count() : 0,
            'opero_leads' => Schema::hasTable('leads') ? Lead::where('product_interest', 'opero')->count() : 0,
            'solutions_leads' => Schema::hasTable('leads') ? Lead::where(function ($q) {
                $q->whereNull('product_interest')
                  ->orWhereNotIn('product_interest', ['itikia', 'opero']);
            })->count() : 0,
            'won_deals' => Schema::hasTable('leads') ? Lead::where('status', 'won')->count() : 0,
            'unread_messages' => Schema::hasTable('contact_messages') ? ContactMessage::where('status', 'new')->count() : 0,
            'total_messages' => Schema::hasTable('contact_messages') ? ContactMessage::count() : 0,
            'confirmed_bookings' => Schema::hasTable('bookings') ? Booking::where('status', 'confirmed')->count() : 0,
            'total_bookings' => Schema::hasTable('bookings') ? Booking::count() : 0,
        ];

        $radar = \App\Services\LeadAlertService::getRadarData();

        return view('admin.dashboard', compact('posts', 'leads', 'messages', 'bookings', 'stats', 'categories', 'radar'));
    }
}
