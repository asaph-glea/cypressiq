<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request and enforce departmental role permissions.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('admin.login');
        }

        // Account suspension check
        if (!$user->is_active) {
            ActivityLog::record(
                'auth.suspended_access_blocked',
                "Suspended user '{$user->email}' attempted access to {$request->path()}.",
                null,
                ['path' => $request->path()],
                $user
            );

            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your account has been deactivated. Please contact an administrator.'], 403);
            }

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Your account has been deactivated. Please contact an administrator.',
            ]);
        }

        // Super Admin has universal access
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if user has one of the allowed roles
        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Log unauthorized privilege escalation / access attempt
        ActivityLog::record(
            'security.unauthorized_attempt',
            "User '{$user->name}' ({$user->roleLabel()}) was denied access to route: {$request->path()}.",
            null,
            [
                'required_roles' => $roles,
                'user_role'      => $user->role,
                'path'           => $request->path(),
                'method'         => $request->method(),
            ],
            $user
        );

        if ($request->expectsJson()) {
            return response()->json([
                'success' => 0,
                'message' => 'Forbidden. You do not have permission to perform this action.',
            ], 403);
        }

        abort(403, "Access Denied: Your role ({$user->roleLabel()}) does not have permission to view or manage this resource.");
    }
}
