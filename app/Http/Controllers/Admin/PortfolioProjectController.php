<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class PortfolioProjectController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(PortfolioProject::ordered()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:portfolio_projects,slug',
            'client_name'     => 'nullable|string|max:255',
            'industry'        => 'nullable|string|max:255',
            'category'        => 'required|string|max:255',
            'summary'         => 'required|string',
            'description'     => 'nullable|string',
            'cover_image'     => 'nullable|string|max:500',
            'gallery_images'  => 'nullable|array',
            'technologies'    => 'nullable|array',
            'outcomes'        => 'nullable|array',
            'project_url'     => 'nullable|url|max:500',
            'duration'        => 'nullable|string|max:100',
            'completed_at'    => 'nullable|date',
            'is_featured'     => 'boolean',
            'is_published'    => 'boolean',
            'sort_order'      => 'integer',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        return response()->json(PortfolioProject::create($data), 201);
    }

    public function show(PortfolioProject $portfolioProject): JsonResponse
    {
        return response()->json($portfolioProject);
    }

    public function update(Request $request, PortfolioProject $portfolioProject): JsonResponse
    {
        $data = $request->validate([
            'title'           => 'sometimes|required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:portfolio_projects,slug,' . $portfolioProject->id,
            'client_name'     => 'nullable|string|max:255',
            'industry'        => 'nullable|string|max:255',
            'category'        => 'sometimes|required|string|max:255',
            'summary'         => 'sometimes|required|string',
            'description'     => 'nullable|string',
            'cover_image'     => 'nullable|string|max:500',
            'gallery_images'  => 'nullable|array',
            'technologies'    => 'nullable|array',
            'outcomes'        => 'nullable|array',
            'project_url'     => 'nullable|url|max:500',
            'duration'        => 'nullable|string|max:100',
            'completed_at'    => 'nullable|date',
            'is_featured'     => 'boolean',
            'is_published'    => 'boolean',
            'sort_order'      => 'integer',
        ]);

        $portfolioProject->update($data);
        return response()->json($portfolioProject->fresh());
    }

    public function destroy(PortfolioProject $portfolioProject): JsonResponse
    {
        $portfolioProject->delete();
        return response()->json(['message' => 'Project deleted.']);
    }
}
