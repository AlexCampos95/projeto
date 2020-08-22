<?php

namespace App\Domain\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class MountUserByRequestDataTest extends TestCase
{
    const PASSWORD = "123";
    const EMAIL = 'AQuiumEmAiL@Email';
    const CPF_CNPJ = "070.834.420-88";

    /**
     * @dataProvider scenarioPassword
     *
     * @param $request
     */
    public function testMountUserPasswordByRequestData(Request $request)
    {
        $mountData = new MountUserByRequestData();
        $userData = $mountData->run($request);

        self::assertEquals(true, Hash::check(self::PASSWORD, $userData['password']));
    }

    public function scenarioPassword()
    {
        $request = new Request();
        $request->merge(["password" => self::PASSWORD]);
        return [
            "Cenário Password" => [$request]
        ];
    }

    /**
     * @dataProvider scenarioEmail
     *
     * @param $request
     */
    public function testMountUserEmailByRequestData(Request $request)
    {
        $mountData = new MountUserByRequestData();
        $userData = $mountData->run($request);

        self::assertEquals(strtolower(self::EMAIL), $userData['email']);
    }

    public function scenarioEmail()
    {
        $request = new Request();
        $request->merge(["email" => self::EMAIL]);
        return [
            "Cenário Email" => [$request]
        ];
    }

    /**
     * @dataProvider scenarioCPFCNPJ
     *
     * @param $request
     */
    public function testMountUserCPFCNPJByRequestData(Request $request)
    {
        $mountData = new MountUserByRequestData();
        $userData = $mountData->run($request);

        self::assertEquals("07083442088", $userData["cpf_cnpj"]);
    }

    public function scenarioCPFCNPJ()
    {
        $request = new Request();
        $request->merge(["cpf_cnpj" => self::CPF_CNPJ]);
        return [
            "Cenário cpf_cnpj" => [$request]
        ];
    }


}
