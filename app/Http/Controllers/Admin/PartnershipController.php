<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PartnershipController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Partnership::ordered()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'partner_name'     => 'required|string|max:255',
            'partner_logo'     => 'nullable|string|max:500',
            'partner_website'  => 'nullable|url|max:500',
            'partnership_type' => 'in:technology,client,reseller,strategic',
            'description'      => 'nullable|string',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'sort_order'       => 'integer',
        ]);

        return response()->json(Partnership::create($data), 201);
    }

    public function show(Partnership $partnership): JsonResponse
    {
        return response()->json($partnership);
    }

    public function update(Request $request, Partnership $partnership): JsonResponse
    {
        $data = $request->validate([
            'partner_name'     => 'sometimes|required|string|max:255',
            'partner_logo'     => 'nullable|string|max:500',
            'partner_website'  => 'nullable|url|max:500',
            'partnership_type' => 'in:technology,client,reseller,strategic',
            'description'      => 'nullable|string',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'sort_order'       => 'integer',
        ]);

        $partnership->update($data);
        return response()->json($partnership);
    }

    public function destroy(Partnership $partnership): JsonResponse
    {
        $partnership->delete();
        return response()->json(['message' => 'Partnership deleted.']);
    }
}
