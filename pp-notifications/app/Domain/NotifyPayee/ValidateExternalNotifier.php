<?php

namespace App\Domain\NotifyPayee;

use App\Common\ExternalNotifier\Api as ExternalNotifier;
use Illuminate\Http\Request;

class ValidateExternalNotifier
{
    public function run(ExternalNotifier $externalNotifierApi, Request $request)
    {
        $response = $externalNotifierApi->run($request);

        if (empty($response['message']) || $response['message'] != ExternalNotifier::SENDED) {
            abort(401, "Not notified");
        }
    }
}