<?php

namespace Domain\Transfer;

use App\Domain\Transfer\ValidatePayerBalance;
use App\Models\Wallet;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidatePayerBalanceTest extends TestCase
{
    /**
     * @dataProvider scenarioNotEnougth
     *
     * @param Request $request
     * @param Wallet $wallet
     */
    public function testValidatePayerBalance(Request $request, Wallet $wallet)
    {
        $this->expectException(HttpException::class);
        $validator = new ValidatePayerBalance();
        $validator->run($request, $wallet);
    }

    public function scenarioNotEnougth()
    {
        $request = new Request();
        $request->merge(["value" => 999999]);

        $userWallet = $this->createMock(Wallet::class);

        return [
            'Cenario pagador sem dinheiro suficiente' => [$request, $userWallet]
        ];
    }
}
