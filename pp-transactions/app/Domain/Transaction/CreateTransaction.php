<?php


namespace App\Domain\Transaction;


use App\Common\PubSubAbstraction;
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

            (new PubSubAbstraction())->run($transactionCreated->getAttributes());

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, "Transaction creation failed");
        }
    }
}