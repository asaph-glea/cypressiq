<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(
            Post::latest()->get(['id', 'title', 'slug', 'status', 'category_id', 'author_id', 'created_at'])
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string|max:200000',
            'excerpt'          => 'nullable|string|max:500',
            'status'           => 'required|in:draft,published,scheduled',
            'category_id'      => 'nullable|exists:categories,id',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Sanitise slug — ensure uniqueness
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($validated['title']);

        // Append a suffix if slug already exists
        $originalSlug = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        $validated['slug']      = $slug;
        $validated['author_id'] = auth()->id();

        $post = Post::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Post created successfully',
                'post'    => $post->only(['id', 'title', 'slug', 'status', 'created_at']),
            ], 201);
        }

        return back()->with('success', 'Post saved successfully!');
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return response()->json(
            $post->only(['id', 'title', 'slug', 'excerpt', 'content', 'status',
                         'category_id', 'author_id', 'meta_title', 'meta_description', 'created_at'])
        );
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string|max:200000',
            'excerpt'          => 'nullable|string|max:500',
            'status'           => 'required|in:draft,published,scheduled',
            'category_id'      => 'nullable|exists:categories,id',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            // Slug must be unique in the posts table, EXCEPT for the current post
            'slug'             => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
        ]);

        if ($request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Do NOT allow author_id or views to be overridden from the request
        unset($validated['author_id'], $validated['views']);

        $post->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Post updated successfully',
                'post'    => $post->only(['id', 'title', 'slug', 'status', 'updated_at']),
            ]);
        }

        return back()->with('success', 'Post updated successfully!');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }

        return back()->with('success', 'Post deleted successfully');
    }
}
