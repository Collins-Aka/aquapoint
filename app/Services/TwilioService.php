<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $fromNumber;
    
    public function __construct()
    {
        $this->client = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );
        $this->fromNumber = env('TWILIO_WHATSAPP_FROM');
    }
    
    public function sendWhatsAppMessage($to, $message)
    {
        // The $to parameter should be in format: whatsapp:+1234567890
        return $this->client->messages->create($to, [
            'from' => $this->fromNumber,
            'body' => $message
        ]);
    }

}