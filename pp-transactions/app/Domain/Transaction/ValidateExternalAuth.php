<?php

namespace App\Domain\Transaction;

use App\Common\ExternalAuth\Api;
use App\Common\ExternalAuth\Api as AuthApi;

class ValidateExternalAuth
{
    public function run(Api $externalAuthApi)
    {
        $response = $externalAuthApi->run();

        if (empty($response['message']) || $response['message'] != AuthApi::AUTHORIZED) {
            abort(401,"Transaction unauthorized");
        }
    }
}