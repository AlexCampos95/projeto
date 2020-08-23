<?php

namespace Domain\NotifyPayee;

use App\Common\ExternalNotifier\Api;
use App\Domain\NotifyPayee\ValidateExternalNotifier;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateExternalNotifierTest extends TestCase
{
    /** @dataProvider scenarioError
     *
     * @param $externalNotifier
     * @param $request
     */
    public function testValidateExternalAuthError($externalNotifier, $request)
    {
        $this->expectException(HttpException::class);
        $validator = new ValidateExternalNotifier();
        $validator->run($externalNotifier, $request);
    }

    public function scenarioError()
    {
        $externalNotifierError = $this->createMock(Api::class);
        $externalNotifierError->method('run')->willReturn(["message" => 'error']);

        $externalNotifierWithOutAttribute = $this->createMock(Api::class);
        $externalNotifierWithOutAttribute->method('run')->willReturn(['error']);

        return [
            'Cenario com erro de notificação' => [$externalNotifierError, new Request()],
            'Cenario sem attributo message' => [$externalNotifierWithOutAttribute, new Request()]
        ];
    }

    /**
     * @dataProvider scenarioRight
     *
     * @param $externalNotifier
     * @param $request
     */
    public function testValidateExternalAuthRight($externalNotifier, $request)
    {
        $validator = new ValidateExternalNotifier();
        $validator->run($externalNotifier, $request);

        self::assertEquals(true, true);
    }

    public function scenarioRight()
    {
        $externalNotifier = $this->createMock(Api::class);
        $externalNotifier->method('run')->willReturn(["message" => Api::SENDED]);

        return [
            'Cenario sem erro de notificação' => [$externalNotifier, new Request()]
        ];
    }
}
