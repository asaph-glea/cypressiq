<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductVideoController extends Controller
{
    /**
     * Retrieve all configured product videos mapped by key.
     */
    public function index()
    {
        return response()->json([
            'success' => 1,
            'videos'  => ProductVideo::allAsMap(),
        ]);
    }

    /**
     * Update video configuration and/or upload new video/poster files.
     */
    public function update(Request $request, string $product_key)
    {
        $validKeys = ['opero', 'itikia', 'solutions'];
        if (!in_array($product_key, $validKeys)) {
            return response()->json([
                'success' => 0,
                'message' => "Invalid product key. Must be one of: " . implode(', ', $validKeys),
            ], 422);
        }

        $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:500',
            'video_url'   => 'nullable|string|max:2000',
            'poster_url'  => 'nullable|string|max:2000',
            'video_file'  => 'nullable|file|mimes:mp4,webm,ogg,mov,m4v|max:102400', // 100MB max
            'poster_file' => 'nullable|file|mimes:jpeg,png,jpg,webp,svg|max:10240',   // 10MB max
            'autoplay'    => 'nullable|boolean',
            'loop'        => 'nullable|boolean',
            'muted'       => 'nullable|boolean',
        ]);

        $video = ProductVideo::firstOrNew(['product_key' => $product_key]);

        // 1. Process Video File Upload (if provided)
        if ($request->hasFile('video_file') && $request->file('video_file')->isValid()) {
            $file = $request->file('video_file');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = "{$product_key}-walkthrough-" . Str::random(8) . ".{$ext}";
            $path = $file->storeAs('videos', $filename, 'public');
            $video->video_url = Storage::url($path);
        } elseif ($request->filled('video_url')) {
            $video->video_url = trim($request->input('video_url'));
        }

        // 2. Process Poster File Upload (if provided)
        if ($request->hasFile('poster_file') && $request->file('poster_file')->isValid()) {
            $poster = $request->file('poster_file');
            $ext = strtolower($poster->getClientOriginalExtension());
            $filename = "{$product_key}-poster-" . Str::random(8) . ".{$ext}";
            $path = $poster->storeAs('images/posters', $filename, 'public');
            $video->poster_url = Storage::url($path);
        } elseif ($request->filled('poster_url')) {
            $video->poster_url = trim($request->input('poster_url'));
        }

        // 3. Process Text Metadata
        if ($request->filled('title')) {
            $video->title = trim($request->input('title'));
        }
        if ($request->has('subtitle')) {
            $video->subtitle = trim((string) $request->input('subtitle'));
        }
        if ($request->has('autoplay')) {
            $video->autoplay = $request->boolean('autoplay');
        }
        if ($request->has('loop')) {
            $video->loop = $request->boolean('loop');
        }
        if ($request->has('muted')) {
            $video->muted = $request->boolean('muted');
        }

        $video->save();

        \App\Models\ActivityLog::record(
            'video.updated',
            "Updated marketing walkthrough video for product '{$product_key}'.",
            $video,
            ['product_key' => $product_key, 'video_url' => $video->video_url]
        );

        return response()->json([
            'success' => 1,
            'message' => strtoupper($product_key) . ' video walkthrough updated successfully.',
            'video'   => $video,
        ]);
    }
}
