<?php

namespace App\Http\Controllers;

use App\Services\ObjectDetectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function showForm()
    {
        return view('object-detection');
    }

    public function detectObjects(Request $request, ObjectDetectionService $service)

    {
        try {
            // Validate the image request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Store the uploaded image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);

            // Detect objects in the image
            $output = $service->detectObjects('public/images/' . $imageName);

            // Return the output
            return response()->json($output);
        } catch (\Exception $e) {
            // Log the error
            Log::error($e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Failed to detect objects'], 500);
        }

        return view('object-detection-results', ['output' => $output]);
    }
}
