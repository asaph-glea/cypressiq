<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TrustController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductVideoController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\PortfolioProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuditController;

// ── Public Routes: Primary Navigation ──────────────────────────────────────
Route::view('/', 'home')->name('home');

// ── Products (CypressIQ's Own Software) ────────────────────────────────────
Route::view('/opero', 'opero')->name('opero');
Route::view('/itikia', 'itikia')->name('itikia');

// Backward-compatibility & SEO redirects for Products
Route::redirect('/products/opero', '/opero', 301)->name('products.opero');
Route::redirect('/products/itikia', '/itikia', 301)->name('products.itikia');
Route::redirect('/opero-erp', '/opero', 301);

// ── Solutions (Technology Built for Clients) ───────────────────────────────
Route::view('/web-development', 'solutions.web-development')->name('solutions.web-development');
Route::view('/custom-software', 'solutions.custom-software')->name('solutions.custom-software');
Route::view('/business-systems', 'solutions.business-systems')->name('solutions.business-systems');
Route::view('/automation-integrations', 'solutions.automation-integrations')->name('solutions.automation-integrations');
Route::view('/digital-platforms', 'solutions.digital-platforms')->name('solutions.digital-platforms');
Route::view('/technology-consulting', 'solutions.technology-consulting')->name('solutions.technology-consulting');

// Backward-compatibility & SEO redirects for Solutions
Route::redirect('/custom-technology', '/custom-software', 301)->name('custom-technology');
Route::redirect('/services', '/custom-software', 301)->name('services');
Route::redirect('/digital-transformation', '/technology-consulting', 301)->name('digital-transformation');

// ── Work ───────────────────────────────────────────────────────────────────
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/case-studies', 'case-studies')->name('case-studies');

// ── Trust & Social Proof ──────────────────────────────────────────────────
Route::get('/trust', [TrustController::class, 'index'])->name('trust');

// ── Preserved Pages, About & Contact ───────────────────────────────────────
Route::view('/tools', 'tools')->name('tools');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::redirect('/login', '/admin/login')->name('login');

// ── Blog Routes (rate-limited to 60 req/min per IP) ──────────────────────────
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// ── Lead Intake & Consultation Submissions ──────────────────────────────────
Route::post('/contact-submit', [\App\Http\Controllers\ContactController::class, 'submitMessage']);
Route::post('/booking-submit', [\App\Http\Controllers\ContactController::class, 'submitBooking']);
Route::post('/lead-capture', [\App\Http\Controllers\ContactController::class, 'submitLead'])
    ->middleware('throttle:15,1')
    ->name('lead.capture');


// ── Admin Routes ──────────────────────────────────────────────────────────────
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // Authentication (unauthenticated users only)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    // Login POST: max 5 attempts per minute per IP (brute-force protection)
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit')
        ->middleware('throttle:5,1');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes — requires authenticated admin user
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // API Endpoints for Dashboard (CSRF protected via web middleware stack)
        Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

            // ── Universal Read Endpoints (Scoped by frontend panel access) ──
            Route::get('radar', [LeadController::class, 'radar'])->name('radar');
            Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
            Route::get('leads/{id}', [LeadController::class, 'show'])->name('leads.show');
            Route::get('contact-settings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getSettings']);
            Route::get('messages', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getMessages']);
            Route::get('bookings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getBookings']);
            Route::get('product-videos', [ProductVideoController::class, 'index'])->name('product-videos.index');
            Route::get('testimonials', [TestimonialController::class, 'index']);
            Route::get('partnerships', [PartnershipController::class, 'index']);
            Route::get('portfolio-projects', [PortfolioProjectController::class, 'index']);
            Route::get('posts', [PostController::class, 'index'])->name('posts.index');
            Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');

            // ── Super Admin Only: User Administration & Security Audit Trail ──
            Route::middleware('role:super_admin')->group(function () {
                Route::get('users', [UserController::class, 'index'])->name('users.index');
                Route::post('users', [UserController::class, 'store'])->name('users.store');
                Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
                Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
                Route::get('audit-logs', [AuditController::class, 'index'])->name('audit-logs.index');
            });

            // ── Growth & Marketing (Sales + Content) Mutations ──
            Route::middleware('role:super_admin,growth')->group(function () {
                Route::post('posts', [PostController::class, 'store'])->name('posts.store');
                Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
                Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

                Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
                Route::put('leads/{id}', [LeadController::class, 'update'])->name('leads.update');
                Route::delete('leads/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');
                Route::put('leads/{id}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
                Route::put('leads/{id}/priority', [LeadController::class, 'updatePriority'])->name('leads.priority');
                Route::post('leads/{id}/notes', [LeadController::class, 'addNote'])->name('leads.notes');
                Route::put('leads/{id}/assign', [LeadController::class, 'assign'])->name('leads.assign');

                Route::put('contact-settings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateSettings']);
                Route::put('messages/{id}/status', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateMessageStatus']);
                Route::put('bookings/{id}/status', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateBookingStatus']);

                Route::post('testimonials', [TestimonialController::class, 'store']);
                Route::put('testimonials/{id}', [TestimonialController::class, 'update']);
                Route::delete('testimonials/{id}', [TestimonialController::class, 'destroy']);

                Route::post('partnerships', [PartnershipController::class, 'store']);
                Route::put('partnerships/{id}', [PartnershipController::class, 'update']);
                Route::delete('partnerships/{id}', [PartnershipController::class, 'destroy']);

                Route::post('portfolio-projects', [PortfolioProjectController::class, 'store']);
                Route::put('portfolio-projects/{id}', [PortfolioProjectController::class, 'update']);
                Route::delete('portfolio-projects/{id}', [PortfolioProjectController::class, 'destroy']);
            });

            // ── Product & Engineering Mutations ──
            Route::middleware('role:super_admin,product_engineer')->group(function () {
                Route::post('product-videos/{product_key}', [ProductVideoController::class, 'update'])->name('product-videos.update');
                Route::post('upload', [MediaController::class, 'upload'])->name('upload');
            });
        });
    });
});

