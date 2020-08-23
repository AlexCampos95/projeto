<?php

namespace Domain\Transaction;

use App\Common\ExternalAuth\Api;
use App\Domain\Transaction\ValidateExternalAuth;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateExternalAuthTest extends TestCase
{

    public function scenarioError()
    {
        $externalAuthError = $this->createMock(Api::class);
        $externalAuthError->method('run')->willReturn(["message" => 'error']);

        $externalAuthWithOutAttribute = $this->createMock(Api::class);
        $externalAuthWithOutAttribute->method('run')->willReturn(['error']);

        return [
            'Cenario com erro de autorização' => [$externalAuthError],
            'Cenario sem attributo message' => [$externalAuthWithOutAttribute]
       ];
    }

    /** @dataProvider scenarioError
     *
     * @param $externalAuth
     */
    public function testValidateExternalAuthError($externalAuth)
    {
        $this->expectException(HttpException::class);
        $validator = new ValidateExternalAuth();
        $validator->run($externalAuth);
    }


    public function scenarioRight()
    {
        $externalAuth = $this->createMock(Api::class);
        $externalAuth->method('run')->willReturn(["message" => Api::AUTHORIZED]);

        return [
            'Cenario sem erro de autorização' => [$externalAuth]
        ];
    }

    /**
     * @dataProvider scenarioRight
     * 
     * @param $externalAuth
     */
    public function testValidateExternalAuthRight($externalAuth)
    {
        $validator = new ValidateExternalAuth();
        $validator->run($externalAuth);

        self::assertEquals(true,true);
    }
}
