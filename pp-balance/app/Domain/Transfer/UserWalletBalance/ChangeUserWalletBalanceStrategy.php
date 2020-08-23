<?php

namespace App\Domain\Transfer\UserWalletBalance;

interface ChangeUserWalletBalanceStrategy
{
    public function run(float $userBalance, float $value): float;
}