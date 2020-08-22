<?php

namespace App\Domain\Login;

use App\Models\Users;

class GetUserByEmail
{
    public function run($email): Users
    {
        $user = Users::where('email', $email)->first();

        if (is_null($user)) {
            abort(401, 'Username or password is invalid');
        }

        return $user;
    }
}