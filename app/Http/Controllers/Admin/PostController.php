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
            Post::latest()->get(['id', 'title', 'slug', 'status', 'category_id', 'author_id', 'featured_image', 'video_url', 'created_at'])
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string|max:500000',
            'excerpt'          => 'nullable|string|max:1000',
            'status'           => 'required|in:draft,published,scheduled',
            'category_id'      => 'nullable|exists:categories,id',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image'   => 'nullable|string|max:500',
            'video_url'        => 'nullable|string|max:500',
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

        \App\Models\ActivityLog::record(
            'post.created',
            "Published or drafted thought leadership post: '{$post->title}'.",
            $post,
            ['status' => $post->status, 'slug' => $post->slug]
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'post'    => $post,
            ], 201);
        }

        return back()->with('success', 'Post saved successfully!');
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return response()->json(
            $post->only([
                'id', 'title', 'slug', 'excerpt', 'content', 'status',
                'category_id', 'author_id', 'meta_title', 'meta_description',
                'featured_image', 'video_url', 'created_at', 'updated_at'
            ])
        );
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string|max:500000',
            'excerpt'          => 'nullable|string|max:1000',
            'status'           => 'required|in:draft,published,scheduled',
            'category_id'      => 'nullable|exists:categories,id',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'slug'             => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'featured_image'   => 'nullable|string|max:500',
            'video_url'        => 'nullable|string|max:500',
        ]);

        if ($request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Do NOT allow author_id or views to be overridden from the request
        unset($validated['author_id'], $validated['views']);

        $post->update($validated);

        \App\Models\ActivityLog::record(
            'post.updated',
            "Updated post '{$post->title}' (status: {$post->status}).",
            $post,
            ['status' => $post->status]
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'post'    => $post,
            ]);
        }

        return back()->with('success', 'Post updated successfully!');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;
        $post->delete();

        \App\Models\ActivityLog::record(
            'post.deleted',
            "Deleted post '{$title}'.",
            null,
            ['deleted_post_title' => $title]
        );

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully'
            ]);
        }

        return back()->with('success', 'Post deleted successfully');
    }
}
