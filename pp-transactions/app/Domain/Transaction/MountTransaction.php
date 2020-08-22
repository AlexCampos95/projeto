<?php


namespace App\Domain\Transaction;


use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;

class MountTransaction
{
    public function run(Request $request, GenericUser $user): array
    {
        return [
            "payer" => $user->id,
            "payee" => $request->payee,
            "value" => $request->value
        ];
    }
}