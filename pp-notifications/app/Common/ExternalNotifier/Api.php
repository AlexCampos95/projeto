<?php

namespace App\Common\ExternalNotifier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Api
{
    const SENDED = 'Enviado';

    public function run(Request $request)
    {
        $response = Http::post(env('CONFIG_URL_EXTERNAL_NOTIFIER'), $request->all());
        return $response->json();
    }
}