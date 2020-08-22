<?php

namespace App\Domain\Users;

use App\Models\UserTypes;
use Illuminate\Http\Request;

class ValidateUserTypesIdExists
{
    public function run(Request $request): void
    {
        UserTypes::where('id', $request->user_types_id)->firstOr(function () {
            abort(422, "User type ID entered does not exist");
        });
    }
}