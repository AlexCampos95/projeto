<?php


namespace App\Domain\Transfer;


use App\Models\Wallet;
use Illuminate\Http\Request;

class ValidatePayerBalance
{
    public function run(Request $request, Wallet $payerWallet): void
    {
        if ($payerWallet->balance < $request->value) {
            abort(422, "The user does not have enough money");
        }
    }
}