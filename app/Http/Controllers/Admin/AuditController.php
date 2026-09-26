<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    /**
     * Retrieve paginated and filterable activity audit logs.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::orderBy('created_at', 'desc');

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->filled('action_category')) {
            $cat = $request->input('action_category');
            $query->where('action', 'like', "{$cat}.%");
        }

        if ($request->filled('search')) {
            $s = trim($request->input('search'));
            $query->where(function ($q) use ($s) {
                $q->where('description', 'like', "%{$s}%")
                  ->orWhere('user_name', 'like', "%{$s}%")
                  ->orWhere('user_email', 'like', "%{$s}%")
                  ->orWhere('ip_address', 'like', "%{$s}%")
                  ->orWhere('action', 'like', "%{$s}%");
            });
        }

        $logs = $query->paginate(30)->through(function ($log) {
            return [
                'id'          => $log->id,
                'action'      => $log->action,
                'description' => $log->description,
                'user_name'   => $log->user_name,
                'user_email'  => $log->user_email,
                'role'        => $log->role,
                'ip_address'  => $log->ip_address,
                'time_ago'    => $log->created_at->diffForHumans(),
                'date'        => $log->created_at->format('M j, Y H:i:s'),
                'properties'  => $log->properties,
            ];
        });

        return response()->json([
            'success' => 1,
            'logs'    => $logs,
        ]);
    }
}
