<?php

namespace App\Domain\Login;

use App\Models\Users;
use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;

class GenerateTokenTest extends TestCase
{
    /** @var Users|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->user = $this->createMock(Users::class);
    }

    public function testGenerateToken()
    {
        $generateToken = new GenerateToken();
        $token = $generateToken->run($this->user);

        $tokenDecoded = JWT::decode($token, env('JWT_KEY'), ['HS256']);

        self::assertArrayHasKey('userId', (array)$tokenDecoded);
        self::assertArrayHasKey('userTypesId', (array)$tokenDecoded);
    }
}
