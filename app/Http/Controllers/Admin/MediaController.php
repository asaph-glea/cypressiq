<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Handle secure file upload for WYSIWYG editor or media manager.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // max 2MB
        ]);

        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            
            // Generate a random, safe filename
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Store file securely in the 'public/uploads' directory
            $path = $file->storeAs('uploads', $filename, 'public');

            // Return JSON response format expected by typical editors (e.g. Editor.js / custom Fetch)
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => Storage::url($path),
                ],
            ]);
        }

        return response()->json(['success' => 0, 'message' => 'Upload failed.'], 400);
    }
}
