<?php

namespace App\Domain\Login;

use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidadeUserPasswordTest extends TestCase
{
    public function testValidateUserWrongPassword()
    {
        $this->expectException(HttpException::class);

        $passwordA = Hash::make("123");
        $passwordB = Hash::make("1564");

        $validator = new ValidadeUserPassword();
        $validator->run($passwordA,$passwordB);
    }
}