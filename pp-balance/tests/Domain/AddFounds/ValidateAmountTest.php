<?php

namespace Domain\AddFounds;

use App\Domain\AddFounds\ValidateAmount;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateAmountTest extends TestCase
{
    public function testValidateAmountZero()
    {
        $this->expectException(HttpException::class);
        $validator = new ValidateAmount();
        $validator->run(0);
    }

    public function testValidateNegativeAmount()
    {
        $this->expectException(HttpException::class);
        $validator = new ValidateAmount();
        $validator->run(-1);
    }

    public function testValidatePositiveAmount()
    {
        $validator = new ValidateAmount();
        $validator->run(1);

        self::assertEquals(true, true);
    }
}
