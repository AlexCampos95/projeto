<?php

namespace App\Domain\Transfer\UserWalletBalance;

class AddPayeeMoney implements ChangeUserWalletBalanceStrategy
{
    public function run(float $useBalance, float $value): float
    {
        return $useBalance + $value;
    }
}