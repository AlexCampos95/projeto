<?php

namespace App\Http\Controllers;

use App\Common\ExternalNotifier\Api;
use App\Common\PubSubAbstraction;
use App\Domain\NotifyPayee\ValidateExternalNotifier;
use Exception;
use Illuminate\Http\Request;

class NotifyPayeeController
{
    public function execute(Request $request)
    {
        try {
            $notifierValidator = new ValidateExternalNotifier();
            $notifierValidator->run(new Api(), $request);

            return response()->json('sended');
        } catch (Exception $e) {
            (new PubSubAbstraction)->run($request);
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}