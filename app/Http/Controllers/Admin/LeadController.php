<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Lead::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'  => 'required|email|max:255',
            'source' => 'nullable|string|max:255',
            'type'   => 'nullable|string|max:255',
        ]);

        $lead = Lead::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
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
            'email'  => 'required|email|max:255',
            'source' => 'nullable|string|max:255',
            'type'   => 'nullable|string|max:255',
        ]);

        $lead->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Lead updated successfully',
                'lead'    => $lead,
            ]);
        }

        return back()->with('success', 'Lead updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Lead deleted successfully']);
        }

        return back()->with('success', 'Lead deleted successfully');
    }
}
