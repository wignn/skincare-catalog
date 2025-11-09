<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public static function sendMessage($number, $message)
    {
        $response = Http::withHeaders([
            'x-api-key' => env('WHATSAPP_API_KEY')
        ])->post(env('WHATSAPP_API_URL'), [
            'number' => $number,
            'message' => $message,
        ]);

        return $response->json();
    }
}
