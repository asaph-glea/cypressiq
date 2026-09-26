<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::ordered()->get();
        return response()->json($testimonials);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'client_name'         => 'required|string|max:255',
            'client_role'         => 'nullable|string|max:255',
            'client_company'      => 'nullable|string|max:255',
            'client_avatar'       => 'nullable|string|max:500',
            'quote'               => 'required|string',
            'rating'              => 'integer|min:1|max:5',
            'product_or_solution' => 'nullable|string|max:255',
            'is_featured'         => 'boolean',
            'is_published'        => 'boolean',
            'sort_order'          => 'integer',
        ]);

        $testimonial = Testimonial::create($data);
        return response()->json($testimonial, 201);
    }

    public function show(Testimonial $testimonial): JsonResponse
    {
        return response()->json($testimonial);
    }

    public function update(Request $request, Testimonial $testimonial): JsonResponse
    {
        $data = $request->validate([
            'client_name'         => 'sometimes|required|string|max:255',
            'client_role'         => 'nullable|string|max:255',
            'client_company'      => 'nullable|string|max:255',
            'client_avatar'       => 'nullable|string|max:500',
            'quote'               => 'sometimes|required|string',
            'rating'              => 'integer|min:1|max:5',
            'product_or_solution' => 'nullable|string|max:255',
            'is_featured'         => 'boolean',
            'is_published'        => 'boolean',
            'sort_order'          => 'integer',
        ]);

        $testimonial->update($data);
        return response()->json($testimonial);
    }

    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted.']);
    }
}
