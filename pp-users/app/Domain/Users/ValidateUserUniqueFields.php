<?php

namespace App\Domain\Users;

use App\Models\Users;
use Illuminate\Http\Request;

class ValidateUserUniqueFields
{
    public function run(Request $request)
    {
        $requestEmail = strtolower($request->email);
        $requestCpfCnpj = preg_replace('~[^0-9]+~', '', $request->cpf_cnpj);

        $user = Users::where('email', $requestEmail)->orWhere('cpf_cnpj', $requestCpfCnpj)->first();
        if (is_null($user)) {
            return;
        }

        $this->validateUniqueEmail($user->email, $requestEmail);
        $this->validateUniqueCpfCnpj($user->cpf_cnpj, $requestCpfCnpj);
    }

    private function validateUniqueEmail($userEmail, $requestEmail): void
    {
        if ($userEmail == $requestEmail) {
            abort(422, "E-mail already exists");
        }
    }

    private function validateUniqueCpfCnpj($userCpfCnpj, $requestCpfCnpj): void
    {
        if ($userCpfCnpj == $requestCpfCnpj) {
            abort(422, "CPF or CNPJ already exists");
        }
    }
}