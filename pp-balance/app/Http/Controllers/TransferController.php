<?php

namespace App\Http\Controllers;

use App\Domain\Transfer\GetUserWallet;
use App\Domain\Transfer\UserWalletBalance\AddPayeeMoney;
use App\Domain\Transfer\UserWalletBalance\ChangeUserWalletBalance;
use App\Domain\Transfer\UserWalletBalance\WithdrawPayerMoney;
use App\Domain\Transfer\ValidatePayerBalance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class TransferController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required',
            'payer' => 'required',
            'payee' => 'required',
            'value' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $userWallet = (new GetUserWallet())->run($request->payer);
            (new ValidatePayerBalance())->run($request, $userWallet);

            $addPayeeMoney = new AddPayeeMoney();
            (new ChangeUserWalletBalance($addPayeeMoney))->run($request->payee, $request->value);

            $withdrawPayerMoney = new WithdrawPayerMoney();
            (new ChangeUserWalletBalance($withdrawPayerMoney))->run($request->payer, $request->value);

            DB::commit();
            return response()->json('User wallet balances, edited');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), $e->getStatusCode());
        }
    }
}