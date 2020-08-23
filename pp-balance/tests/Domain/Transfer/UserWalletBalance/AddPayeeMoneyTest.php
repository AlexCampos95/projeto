<?php

namespace Domain\Transfer\UserWalletBalance;

use App\Domain\Transfer\UserWalletBalance\AddPayeeMoney;
use PHPUnit\Framework\TestCase;

class AddPayeeMoneyTest extends TestCase
{
    public function testAddPayeeMoney()
    {
        $addPayeeMoney = (new AddPayeeMoney());
        $value = $addPayeeMoney->run(5, 5);

        self:
        self::assertEquals(10, $value);
    }
}
