<?php

namespace App\Common\ExternalAuth;

use Illuminate\Support\Facades\Http;

class Api
{
    const AUTHORIZED = 'Autorizado';

    public function run()
    {
        $response = Http::post(env('CONFIG_URL_EXTERNAL_AUTH'), []);
        return $response->json();
    }
}