<?php

namespace Domain\Transaction;

use App\Domain\Transaction\ValidateUserType;
use Exception;
use Illuminate\Auth\GenericUser;
use PHPUnit\Framework\TestCase;

class ValidateUserTypeTest extends TestCase
{
    /**
     * @dataProvider scenarioWrongType
     *
     * @param $user
     */
    public function testValidateUserTypeWrong($user)
    {
        $this->expectException(Exception::class);
        $validator = new ValidateUserType();

        $validator->run($user);
    }

    public function scenarioWrongType()
    {
        $user = new GenericUser(['user_types_id' => 2]);

        return [
            'Cenário com tipo de usuário Lojista' => [
                $user
            ]
        ];
    }

    /**
     * @dataProvider scenarioRightType
     *
     * @param $user
     */
    public function testValidateUserTypeRight($user)
    {
        $validator = new ValidateUserType();
        $validator->run($user);
        self::assertEquals(true,true);
    }

    public function scenarioRightType()
    {
        $user = new GenericUser(['user_types_id' => 1]);

        return [
            'Cenário com tipo de usuário Comum' => [
                $user
            ]
        ];
    }
}
