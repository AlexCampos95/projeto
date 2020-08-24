<?php

namespace Domain\Check;

use App\Common\Enum\TransactionStatus;
use App\Domain\Check\GetStatus;
use PHPUnit\Framework\TestCase;

class GetStatusTest extends TestCase
{
    /**
     * @dataProvider scenarioDone
     * @dataProvider scenarioError
     * @dataProvider scenarioStarted
     *
     * @param array $expectedResult
     * @param int $statusNumber
     */
    public function testGetStatus(array $expectedResult,int $statusNumber)
    {
        $statusGetter = new GetStatus();
        $status = $statusGetter->run($statusNumber);

        self::assertEquals($expectedResult, $status);
    }

    public function scenarioDone()
    {
        $expectedResult['number'] = TransactionStatus::DONE;
        $expectedResult['description'] = "Done";

        return [
            "Cenário status done" => [$expectedResult,TransactionStatus::DONE]
        ];
    }

    public function scenarioError()
    {
        $expectedResult['number'] = TransactionStatus::ERROR;
        $expectedResult['description'] = "Error";

        return [
            "Cenário status error" => [$expectedResult,TransactionStatus::ERROR]
        ];
    }

    public function scenarioStarted()
    {
        $expectedResult['number'] = TransactionStatus::STARTED;
        $expectedResult['description'] = "Started";

        return [
            "Cenário status started" => [$expectedResult,TransactionStatus::STARTED]
        ];
    }
}
