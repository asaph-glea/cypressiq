<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Handle secure file upload for images and videos for blog posts and media library.
     */
    public function upload(Request $request)
    {
        // Support field names: 'file', 'image', or 'media'
        $field = 'file';
        if ($request->hasFile('image')) {
            $field = 'image';
        } elseif ($request->hasFile('media')) {
            $field = 'media';
        }

        $request->validate([
            $field => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg,mp4,webm,ogg,mov,m4v|max:51200', // max 50MB
        ]);

        $file = $request->file($field);

        if ($file && $file->isValid()) {
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = Str::uuid() . '.' . $extension;
            
            // Store file in 'storage/app/public/uploads'
            $path = $file->storeAs('uploads', $filename, 'public');
            $url = Storage::url($path);

            $mime = $file->getMimeType();
            $mediaType = str_starts_with($mime, 'video/') || in_array($extension, ['mp4', 'webm', 'ogg', 'mov', 'm4v']) 
                ? 'video' 
                : 'image';

            return response()->json([
                'success' => 1,
                'url'     => $url,
                'type'    => $mediaType,
                'name'    => $file->getClientOriginalName(),
                'file'    => [
                    'url' => $url,
                ],
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'Upload failed or invalid file.',
        ], 400);
    }
}
