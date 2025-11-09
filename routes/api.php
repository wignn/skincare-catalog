<?php

use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::post('/send-whatsapp', [WhatsappController::class, 'send']);
