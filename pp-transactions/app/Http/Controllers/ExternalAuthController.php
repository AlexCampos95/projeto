<?php

namespace App\Http\Controllers;

use App\Common\ExternalAuth\Api as ExternalApi;

class ExternalAuthController
{
    public function execute()
    {
        return response()->json(["message" => ExternalApi::AUTHORIZED]);
    }
}