<?php

namespace App\Domain\Transfer\UserWalletBalance;

use App\Models\Wallet;

class ChangeUserWalletBalance
{
    private $strategy;

    public function __construct(ChangeUserWalletBalanceStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function run(int $user_id, float $value)
    {
        $userWallet = Wallet::where('id', $user_id)->first();
        $userWallet->balance = $this->strategy->run($userWallet->balance, $value);
        $userWallet->save();
    }
}