<?php

namespace App\Domain\AddFounds;

class ValidateAmount
{
    public function run($amount)
    {
        if ($amount <= 0) {
            abort(412, "Invalid amount");
        }
    }
}