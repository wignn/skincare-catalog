<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $apiUrl;
    protected $apiKey;
    protected $adminNumber;

    public function __construct()
    {
        $this->apiUrl = config('services.whatsapp.url');
        $this->apiKey = config('services.whatsapp.token');
        $this->adminNumber = config('services.whatsapp.admin_number');
    }

    public function sendMessageToAdmin(string $message)
    {
        try {
            return Http::withHeaders([
                    'x-api-key' => $this->apiKey,
                    'Accept' => 'application/json',
                ])
                ->post("{$this->apiUrl}/api/send-message", [
                    'number' => $this->adminNumber,
                    'message' => $message,
                ])
                ->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp send to admin failed: ' . $e->getMessage());
            return null;
        }
    }

    public function sendMessageToCustomer(string $message, string $number)
    {
        try {
            return Http::withHeaders([
                    'x-api-key' => $this->apiKey,
                    'Accept' => 'application/json',
                ])
                ->post("{$this->apiUrl}/api/send-message", [
                    'number' => $number,
                    'message' => $message,
                ])
                ->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp send to customer failed: ' . $e->getMessage());
            return null;
        }
    }
}
