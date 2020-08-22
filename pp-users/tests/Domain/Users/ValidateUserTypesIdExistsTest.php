<?php

namespace Domain\Users;

use App\Domain\Users\ValidateUserTypesIdExists;
use Error;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ValidateUserTypesIdExistsTest extends TestCase
{
    /**
     * @dataProvider scenarioUserTypeNotExists
     *
     * @param $request
     */
    public function testValidateUserTypesIdExists(Request $request)
    {
        $this->expectException(Error::class);
        $validator = new ValidateUserTypesIdExists();
        $validator->run($request);

    }

    public function scenarioUserTypeNotExists()
    {
        $request = new Request();
        $request->merge(["user_types_id" => -1]);
        return [
            "Cenário tipo de usuário inexistente" => [$request]
        ];
    }
}
