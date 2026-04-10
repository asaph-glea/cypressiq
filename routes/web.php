<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// ── Public Static Routes ──────────────────────────────────────────────────────
Route::view('/', 'home')->name('home');
Route::view('/services', 'services')->name('services');
Route::view('/opero-erp', 'opero')->name('opero');
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/tools', 'tools')->name('tools');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// ── Blog Routes (rate-limited to 60 req/min per IP) ──────────────────────────
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// ── Lead Management Form Submissions ─────────────────────────────────────────
Route::post('/contact-submit', [\App\Http\Controllers\ContactController::class, 'submitMessage']);
Route::post('/booking-submit', [\App\Http\Controllers\ContactController::class, 'submitBooking']);

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
            Route::apiResource('posts', PostController::class);
            Route::apiResource('leads', LeadController::class);
            Route::post('upload', [MediaController::class, 'upload'])->name('upload');
            
            // Lead Management System Routes
            Route::get('contact-settings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getSettings']);
            Route::put('contact-settings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateSettings']);
            Route::get('messages', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getMessages']);
            Route::put('messages/{id}/status', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateMessageStatus']);
            Route::get('bookings', [\App\Http\Controllers\Admin\LeadManagementController::class, 'getBookings']);
            Route::put('bookings/{id}/status', [\App\Http\Controllers\Admin\LeadManagementController::class, 'updateBookingStatus']);
        });
    });
});

