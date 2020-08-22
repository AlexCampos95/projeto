<?php

namespace App\Http\Controllers;

use App\Common\Enum\TransactionStatus;
use App\Common\PubSubAbstraction;
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

            $status = TransactionStatus::DONE;
            DB::commit();
        } catch (Exception $e) {
            $status = TransactionStatus::ERROR;
            DB::rollBack();
        }

        (new PubSubAbstraction())->run($status, $request->transaction_id, $request->payee);
    }
}