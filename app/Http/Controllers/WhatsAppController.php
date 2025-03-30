<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Extract message data
        $data = $request->all();
        
        // Process incoming message
        if (isset($data['message']) && isset($data['message']['image'])) {
            // Get image URL
            $imageUrl = $data['message']['image']['url'];
            $sender = $data['sender']['id'];
            
            // Download image
            $imageContent = $this->downloadImage($imageUrl);
            
            // Analyze with IBM watsonx.ai
            $analysis = $this->analyzeWaterImage($imageContent);
            
            // Send response back via WhatsApp
            $this->sendTreatmentRecommendations($sender, $analysis);
        }
        
        return response('OK', 200);
    }
    
    private function downloadImage($url)
    {
        $response = Http::get($url);
        return $response->body();
    }
    
    private function analyzeWaterImage($imageContent)
    {
        // IBM watsonx.ai API call
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('IBM_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(env('IBM_WATSONX_URL') . '/v4/analyze', [
            'collection_ids' => ['water_quality_collection'],
            'features' => [['feature' => 'objects']],
            'images_file' => base64_encode($imageContent)
        ]);
        
        $results = $response->json();
        
        // Process results to determine water quality
        return [
            'turbidity' => $this->detectTurbidity($results),
            'contamination_level' => $this->estimateContamination($results),
            'recommended_treatment' => $this->determineWaterTreatment($results)
        ];
    }
    
    private function detectTurbidity($results)
    {
        // Logic to determine water turbidity from image analysis
        // This is placeholder logic
        return "Medium";
    }
    
    private function estimateContamination($results)
    {
        // Logic to estimate contamination level
        // This is placeholder logic
        return "Moderate";
    }
    
    private function determineWaterTreatment($results)
    {
        // Logic to recommend treatment based on analysis
        // This is placeholder logic
        return "Boil the water for at least 5 minutes, then let it cool before drinking.";
    }
    
    private function sendTreatmentRecommendations($recipient, $analysis)
    {
        // Construct message
        $message = "Water Analysis Results:\n";
        $message .= "- Turbidity: {$analysis['turbidity']}\n";
        $message .= "- Contamination Level: {$analysis['contamination_level']}\n\n";
        $message .= "Recommended Treatment:\n{$analysis['recommended_treatment']}";
        
        // Send via WhatsApp API (implementation depends on provider)
        // Example using a generic API
        Http::post('WHATSAPP_API_ENDPOINT', [
            'recipient' => $recipient,
            'message' => $message
        ]);
    }
}
