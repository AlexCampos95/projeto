<?php

namespace App\Domain\Transaction;

use App\Common\PubSub\Shooter\ShootPubSub;
use App\Models\Transactions;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateTransaction
{
    public function run(array $transaction)
    {
        try {
            DB::beginTransaction();

            $transactionCreated = Transactions::create($transaction);
            if (!$transactionCreated) {
                abort(500, "Transaction creation failed");
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, "Transaction creation failed");
        }

        //Disparo deve ser depois do commit, devido ao processo não ser assíncrono
        (new ShootPubSub())->transactionCreatedRun($transactionCreated->getAttributes());
    }
}