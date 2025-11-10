<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsappService;

class WhatsappController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'message' => 'required'
        ]);

        $result = WhatsappService::sendMessage($request->number, $request->message);

        return response()->json($result);
    }
}
