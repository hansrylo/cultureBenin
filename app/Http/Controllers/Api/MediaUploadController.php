<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Verify token
        $token = $request->bearerToken();
        $expectedToken = env('MIGRATION_TOKEN', 'your-secret-token');
        
        if ($token !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Validate request
        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string',
        ]);
        
        try {
            // Get the uploaded file
            $file = $request->file('file');
            $path = $request->input('path');
            
            // Store the file
            $storedPath = Storage::disk('public')->putFileAs(
                dirname($path),
                $file,
                basename($path)
            );
            
            return response()->json([
                'success' => true,
                'path' => $storedPath,
                'message' => 'File uploaded successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
