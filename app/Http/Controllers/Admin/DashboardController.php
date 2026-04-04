<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $leads = Lead::latest()->get();

        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'scheduled_posts' => Post::where('status', 'scheduled')->count(),
            'total_leads' => Lead::count(),
        ];

        return view('admin.dashboard', compact('posts', 'leads', 'stats'));
    }
}
