<?php

namespace App\Domain\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MountUserByRequestData
{
    public function run(Request $request): array
    {
        $user = $request->all();

        if (isset($user['password'])) {
            $user['password'] = Hash::make($user['password']);
        }

        if (isset($user['email'])) {
            $user['email'] = strtolower($user['email']);
        }

        if (isset($user['cpf_cnpj'])) {
            $user['cpf_cnpj'] = preg_replace('~[^0-9]+~', '', $user['cpf_cnpj']);
        }

        return $user;
    }
}