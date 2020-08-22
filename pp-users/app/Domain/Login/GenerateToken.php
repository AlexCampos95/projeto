<?php

namespace App\Domain\Login;

use App\Models\Users;
use Firebase\JWT\JWT;

class GenerateToken
{
    public function run(Users $user)
    {
        return JWT::encode([
            'userId' => $user->id,
            'userTypesId' => $user->user_types_id
        ], env('JWT_KEY'));
    }
}