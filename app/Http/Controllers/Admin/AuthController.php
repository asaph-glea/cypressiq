<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = 'admin-login:' . $request->ip();

        // 1. Enforce Rate Limiting (5 attempts per minute)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            ActivityLog::record(
                'security.rate_limited_login',
                "Rate limit exceeded for IP: {$request->ip()} attempting to log in as '{$credentials['email']}'.",
                null,
                ['attempted_email' => $credentials['email'], 'retry_after_seconds' => $seconds]
            );

            throw ValidationException::withMessages([
                'email' => ["Too many login attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        // 2. Check User Existence & Active Status
        $user = User::where('email', $credentials['email'])->first();

        if ($user && !$user->is_active) {
            RateLimiter::hit($throttleKey, 60);

            ActivityLog::record(
                'auth.deactivated_attempt',
                "Deactivated user '{$user->email}' attempted login from IP {$request->ip()}.",
                $user,
                ['ip' => $request->ip()],
                $user
            );

            return back()->withErrors([
                'email' => 'Your account has been deactivated. Please contact an administrator.',
            ])->onlyInput('email');
        }

        // 3. Attempt Authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            /** @var User $authenticatedUser */
            $authenticatedUser = Auth::user();
            $authenticatedUser->last_login_at = now();
            $authenticatedUser->last_login_ip = $request->ip();
            $authenticatedUser->save();

            ActivityLog::record(
                'auth.login',
                "User '{$authenticatedUser->name}' ({$authenticatedUser->roleLabel()}) successfully logged into the cockpit.",
                $authenticatedUser,
                ['ip' => $request->ip()],
                $authenticatedUser
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Failed Attempt
        RateLimiter::hit($throttleKey, 60);

        ActivityLog::record(
            'auth.failed_login',
            "Failed login attempt for email '{$credentials['email']}' from IP {$request->ip()}.",
            null,
            ['attempted_email' => $credentials['email'], 'ip' => $request->ip()]
        );

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            ActivityLog::record(
                'auth.logout',
                "User '{$user->name}' ({$user->roleLabel()}) logged out.",
                $user,
                ['ip' => $request->ip()],
                $user
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
