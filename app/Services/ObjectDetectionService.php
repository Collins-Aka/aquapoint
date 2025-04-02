<?php

namespace App\Services;

use Codewithkyrian\Transformers\Models\Auto\AutoModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ObjectDetectionService
{
    public function detectObjects($image)
    {
        try {
            // Load the pre-trained Granite Vision model
            /* $config = [
                'model_type' => 'vision',
                'is_encoder_decoder' => false,
                'architectures' => ['VisionModel'],
                'pad_token_id' => 0,
                'vocab_size' => 30522,
                'hidden_size' => 768,
            ];*/
            $config = [
                'model_type' => 'vision',
            ];
            $model = AutoModel::fromPretrained(
                'ibm/granite-vision-3.2-2b',
                false, // $quantized
                $config, // $config
                null, // $cacheDir
                'main', // $revision
                null, // $modelFilename
                null // $onProgress
            );
            Log::info('Pre-trained model loaded successfully.');

            // Check if the image exists
            if (!Storage::exists($image)) {
                throw new \Exception('Image not found');
            }
            Log::info('Image found.');

            // Perform object detection
            Log::info('Performing object detection...');
            $output = $model->predict(Storage::path($image));
            Log::info('Object detection completed successfully.');

            return $output;
        } catch (\Exception $e) {
            // Dump the exception object
            dd($e);

            // Return an error response
            return response()->json(['error' => 'Failed to detect objects'], 500);
        }
    }
}
