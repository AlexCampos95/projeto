<?php

namespace App\Domain\Transaction;

use App\Common\Enum\UserTypes;
use Illuminate\Auth\GenericUser;

class ValidateUserType
{
    public function run(GenericUser $user)
    {
        if ($user->user_types_id == UserTypes::LOJISTA) {
            abort(412, "The User Type sended can't make transactions");
        }
    }
}