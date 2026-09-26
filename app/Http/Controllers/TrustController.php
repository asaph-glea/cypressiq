<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Partnership;
use App\Models\PortfolioProject;
use Illuminate\View\View;

class TrustController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::published()->ordered()->get();
        $projects     = PortfolioProject::published()->ordered()->get();
        $partnerships = Partnership::published()->ordered()->get();

        return view('trust', compact('testimonials', 'projects', 'partnerships'));
    }
}
