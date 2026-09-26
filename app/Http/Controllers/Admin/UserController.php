<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Retrieve all team members.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get()->map(function ($u) {
            return [
                'id'            => $u->id,
                'name'          => $u->name,
                'email'         => $u->email,
                'role'          => $u->role,
                'role_label'    => $u->roleLabel(),
                'role_badge'    => $u->roleBadgeClass(),
                'is_active'     => (bool) $u->is_active,
                'last_login_at' => $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Never',
                'last_login_ip' => $u->last_login_ip ?: '—',
                'created_at'    => $u->created_at ? $u->created_at->format('M j, Y') : '—',
            ];
        });

        return response()->json([
            'success' => 1,
            'users'   => $users,
        ]);
    }

    /**
     * Create a new team member.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'     => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_GROWTH, User::ROLE_PRODUCT_ENGINEER])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'role'      => $validated['role'],
            'password'  => Hash::make($validated['password']),
            'is_admin'  => true,
            'is_active' => true,
        ]);

        ActivityLog::record(
            'user.created',
            "Created team member '{$user->name}' ({$user->email}) with role: {$user->roleLabel()}.",
            $user,
            ['assigned_role' => $user->role]
        );

        return response()->json([
            'success' => 1,
            'message' => "User '{$user->name}' created successfully.",
            'user'    => $user,
        ]);
    }

    /**
     * Update an existing team member's role or password.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'     => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_GROWTH, User::ROLE_PRODUCT_ENGINEER])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $oldRole = $user->role;
        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        ActivityLog::record(
            'user.updated',
            "Updated team member '{$user->name}'. Role changed from {$oldRole} to {$user->role}.",
            $user,
            ['old_role' => $oldRole, 'new_role' => $user->role]
        );

        return response()->json([
            'success' => 1,
            'message' => "User '{$user->name}' updated successfully.",
            'user'    => $user,
        ]);
    }

    /**
     * Toggle active/suspended state.
     */
    public function toggleStatus(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => 0,
                'message' => 'You cannot deactivate your own account.',
            ], 422);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $action = $user->is_active ? 'reactivated' : 'deactivated';

        ActivityLog::record(
            'user.status_toggled',
            "User '{$user->name}' ({$user->email}) was {$action}.",
            $user,
            ['is_active' => $user->is_active]
        );

        return response()->json([
            'success'   => 1,
            'message'   => "User '{$user->name}' was {$action}.",
            'is_active' => $user->is_active,
        ]);
    }
}
