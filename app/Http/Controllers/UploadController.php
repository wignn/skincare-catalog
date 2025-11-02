<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class UploadController extends Controller
{
    public function store(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Upload
        $path = $request->file('file')->store('products', 's3');
        
        // Generate URL custom domain
        $fileUrl = config('filesystems.disks.s3.url') . '/' . $path;
        
        return response()->json([
            'success' => true,
            'file_url' => $fileUrl,
            'file_path' => $path
        ], 200);
    }
}
