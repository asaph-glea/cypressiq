<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     * Ensures the authenticated user has the is_admin flag set.
     * Redirects non-admins to the login page with a 403 response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin || !auth()->user()->is_active) {
            if (auth()->check() && !auth()->user()->is_active) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Account is deactivated.'], 403);
                }

                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Your account has been deactivated. Please contact an administrator.',
                ]);
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden.'], 403);
            }

            abort(403, 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
