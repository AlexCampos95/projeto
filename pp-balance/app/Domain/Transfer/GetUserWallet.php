<?php

namespace App\Domain\Transfer;

use App\Models\Wallet;

class GetUserWallet
{
    public function run(int $payer): Wallet
    {
        $payerWallet = Wallet::where('user_id', $payer)->first();

        if (!$payerWallet) {
            abort(422, "User Wallet Not Found");
        }

        return $payerWallet;
    }
}