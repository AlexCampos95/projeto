<?php

namespace Domain\Transaction;

use App\Domain\Transaction\MountTransaction;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class MountTransactionTest extends TestCase
{
    const USER_ID = 1;
    const PAYEE = 2;
    const VALUE = 10;

    /** @var Request */
    private $request;

    /** @var GenericUser */
    private $user;

    protected function setUp(): void
    {
        $this->request = new Request();
        $this->request->merge([
            'payee' => self::PAYEE,
            'value' => self::VALUE
        ]);

        $this->user = new GenericUser(['id' => self::USER_ID]);
    }

    public function testMountTransaction()
    {
        $mounter = new MountTransaction();
        $transaction = $mounter->run($this->request, $this->user);

        self::assertIsArray($transaction);
        self::assertArrayHasKey('payer',$transaction);
        self::assertArrayHasKey('payee',$transaction);
        self::assertArrayHasKey('value',$transaction);

        self::assertEquals(self::VALUE,$transaction['value']);
        self::assertEquals(self::PAYEE,$transaction['payee']);
        self::assertEquals(self::USER_ID,$transaction['payer']);
    }
}
