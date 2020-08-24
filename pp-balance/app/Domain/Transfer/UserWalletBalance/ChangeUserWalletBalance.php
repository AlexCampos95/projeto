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
        $userWallet = Wallet::firstOrNew(['user_id' => $user_id]);
        $userWallet->balance = $this->strategy->run((float)$userWallet->balance, $value);
        $userWallet->save();
    }
}