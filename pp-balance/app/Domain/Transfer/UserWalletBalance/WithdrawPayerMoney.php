<?php

namespace App\Domain\Transfer\UserWalletBalance;

class WithdrawPayerMoney implements ChangeUserWalletBalanceStrategy
{
    public function run(float $userBalance, float $value): float
    {
        return $userBalance - $value;
    }
}