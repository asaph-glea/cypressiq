<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource with flexible filtering and search.
     */
    public function index(Request $request)
    {
        $query = Lead::latest();

        // Filter by sales pipeline stage
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by product interest (e.g. itikia, opero, solutions)
        if ($request->filled('product_interest') && $request->product_interest !== 'all') {
            if ($request->product_interest === 'solutions') {
                $query->where(function ($q) {
                    $q->whereNull('product_interest')
                      ->orWhereNotIn('product_interest', ['itikia', 'opero']);
                });
            } else {
                $query->where('product_interest', $request->product_interest);
            }
        }

        // Filter by source
        if ($request->filled('source') && $request->source !== 'all') {
            $query->where('source', $request->source);
        }

        // Filter by priority
        if ($request->filled('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        // Free-text search
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('company', 'like', $search)
                  ->orWhere('project_type', 'like', $search)
                  ->orWhere('notes', 'like', $search);
            });
        }

        return response()->json($query->get());
    }

    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'            => 'required|email|max:255',
            'name'             => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:50',
            'company'          => 'nullable|string|max:255',
            'project_type'     => 'nullable|string|max:255',
            'project_scale'    => 'nullable|string|max:255',
            'bottleneck'       => 'nullable|string',
            'timeline'         => 'nullable|string|max:255',
            'message'          => 'nullable|string',
            'product_interest' => 'nullable|string|max:100',
            'source'           => 'nullable|string|max:255',
            'type'             => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:new,reviewed,qualified,proposal,won,lost',
            'priority'         => 'nullable|string|in:low,medium,high,urgent',
            'notes'            => 'nullable|string',
            'assigned_to'      => 'nullable|string|max:255',
        ]);

        $lead = Lead::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully',
                'lead'    => $lead,
            ], 201);
        }

        return back()->with('success', 'Lead saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);
        return response()->json($lead);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'email'            => 'sometimes|required|email|max:255',
            'name'             => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:50',
            'company'          => 'nullable|string|max:255',
            'project_type'     => 'nullable|string|max:255',
            'project_scale'    => 'nullable|string|max:255',
            'bottleneck'       => 'nullable|string',
            'timeline'         => 'nullable|string|max:255',
            'message'          => 'nullable|string',
            'product_interest' => 'nullable|string|max:100',
            'source'           => 'nullable|string|max:255',
            'type'             => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:new,reviewed,qualified,proposal,won,lost',
            'priority'         => 'nullable|string|in:low,medium,high,urgent',
            'notes'            => 'nullable|string',
            'assigned_to'      => 'nullable|string|max:255',
        ]);

        $lead->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead updated successfully',
                'lead'    => $lead,
            ]);
        }

        return back()->with('success', 'Lead updated successfully!');
    }

    /**
     * Fast inline status transition.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|in:new,reviewed,qualified,proposal,won,lost',
        ]);

        $lead = Lead::findOrFail($id);
        $oldStatus = $lead->status;
        $lead->status = $request->status;
        if (in_array($request->status, ['reviewed', 'qualified', 'proposal'])) {
            $lead->last_contacted_at = now();
        }
        $lead->save();

        \App\Models\ActivityLog::record(
            'lead.stage_update',
            "Transitioned lead '{$lead->name}' ({$lead->email}) from '{$oldStatus}' to '{$lead->status}'.",
            $lead,
            ['old_status' => $oldStatus, 'new_status' => $lead->status]
        );

        return response()->json([
            'success' => true,
            'message' => 'Lead status updated to ' . $request->status,
            'lead'    => $lead,
        ]);
    }

    /**
     * Fast inline priority transition.
     */
    public function updatePriority(Request $request, string $id)
    {
        $request->validate([
            'priority' => 'required|string|in:low,medium,high,urgent',
        ]);

        $lead = Lead::findOrFail($id);
        $oldPriority = $lead->priority;
        $lead->priority = $request->priority;
        $lead->save();

        \App\Models\ActivityLog::record(
            'lead.priority_update',
            "Changed priority for lead '{$lead->name}' from '{$oldPriority}' to '{$lead->priority}'.",
            $lead,
            ['old_priority' => $oldPriority, 'new_priority' => $lead->priority]
        );

        return response()->json([
            'success' => true,
            'message' => 'Lead priority updated to ' . $request->priority,
            'lead'    => $lead,
        ]);
    }

    /**
     * Append internal engineering/sales notes.
     */
    public function addNote(Request $request, string $id)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $lead = Lead::findOrFail($id);
        $timestamp = now()->format('M j, Y H:i');
        $user = auth()->user()->name ?? 'Admin';
        $formattedNote = "[{$timestamp} - {$user}]: " . trim($request->note);

        $lead->notes = $lead->notes ? ($lead->notes . "\n\n" . $formattedNote) : $formattedNote;
        $lead->save();

        \App\Models\ActivityLog::record(
            'lead.note_add',
            "Appended internal deal note to lead '{$lead->name}'.",
            $lead,
            ['note_preview' => \Illuminate\Support\Str::limit($request->note, 60)]
        );

        return response()->json([
            'success' => true,
            'message' => 'Note added successfully',
            'lead'    => $lead,
        ]);
    }

    /**
     * Assign lead to a team member.
     */
    public function assign(Request $request, string $id)
    {
        $request->validate([
            'assigned_to' => 'required|string|max:255',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->assigned_to = $request->assigned_to;
        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Lead assigned to ' . $request->assigned_to,
            'lead'    => $lead,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead deleted successfully'
            ]);
        }

        return back()->with('success', 'Lead deleted successfully');
    }

    /**
     * Return real-time Radar follow-up intelligence and SLA status.
     */
    public function radar()
    {
        return response()->json(\App\Services\LeadAlertService::getRadarData());
    }
}
