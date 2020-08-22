<?php

namespace App\Domain\Login;

use Illuminate\Support\Facades\Hash;

class ValidadeUserPassword
{
    public function run($passwordA,$passwordB)
    {
        if (!Hash::check($passwordA, $passwordB)) {
            abort(401, 'Username or password is invalid');
        }
    }
}