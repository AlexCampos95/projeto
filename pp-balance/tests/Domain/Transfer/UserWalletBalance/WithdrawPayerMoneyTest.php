<?php

namespace Domain\Transfer\UserWalletBalance;

use App\Domain\Transfer\UserWalletBalance\WithdrawPayerMoney;
use PHPUnit\Framework\TestCase;

class WithdrawPayerMoneyTest extends TestCase
{
    public function testWithdrawPayerMoney()
    {
        $addPayeeMoney = (new WithdrawPayerMoney());
        $value = $addPayeeMoney->run(5, 5);

        self:
        self::assertEquals(0, $value);
    }
}
