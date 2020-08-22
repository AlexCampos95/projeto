<?php

namespace App\Domain\Users;

use Error;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * Esse teste espera que as seeders tenham sido executadas
 */
class ValidateUserUniqueFieldsTest extends TestCase
{
    const EMAIL = "jose.email@email";
    const CPF_CNPJ = 97172412010;

    /**
     * @dataProvider scenarioUserEmailAlreadyExists
     * @dataProvider scenarioUserCpfCnpjAlreadyExists
     *
     * @param $request
     */
    public function testValidateUserTypesIdExists(Request $request)
    {
        $this->expectException(Error::class);
        $validator = new ValidateUserUniqueFields();
        $validator->run($request);

    }

    public function scenarioUserEmailAlreadyExists()
    {
        $request = new Request();
        $request->merge(["email" => self::EMAIL]);
        return [
            "Cenário email já cadastrado" => [$request]
        ];
    }

    public function scenarioUserCpfCnpjAlreadyExists()
    {
        $request = new Request();
        $request->merge(["cpf_cnpj" => self::CPF_CNPJ]);
        return [
            "Cenário cpf_cnpj já cadastrado" => [$request]
        ];
    }
}
