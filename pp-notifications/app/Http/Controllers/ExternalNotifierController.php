<?php

namespace App\Http\Controllers;

use App\Common\ExternalNotifier\Api as ExternalNotifier;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class ExternalNotifierController extends Controller
{
    public function execute(Request $request)
    {
        return response()->json(["message" => ExternalNotifier::SENDED]);
    }
}