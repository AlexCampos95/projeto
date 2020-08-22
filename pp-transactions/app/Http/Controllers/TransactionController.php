<?php

namespace App\Http\Controllers;

use App\Common\ExternalAuth\Api as ExternalAuthApi;
use App\Domain\Transaction\CreateTransaction;
use App\Domain\Transaction\MountTransaction;
use App\Domain\Transaction\ValidateExternalAuth;
use App\Domain\Transaction\ValidateUserType;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use Exception;

class TransactionController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'payee' => 'required',
            'value' => 'required'
        ]);

        try {
            /** @var GenericUser $user */

            $user = Auth::user();
            (new ValidateUserType())->run($user);
            (new ValidateExternalAuth())->run(new ExternalAuthApi());

            $transaction = (new MountTransaction())->run($request, $user);
            (new CreateTransaction)->run($transaction);

            return response()->json("Transaction executed", 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getStatusCode());
        }
    }
}