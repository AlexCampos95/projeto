<?php

use App\Models\UserTypes;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTypes::create([
            "id" => 1,
            "description" => "COMUM"
        ]);

        UserTypes::create([
            "id" => 2,
            "description" => "LOJISTA"
        ]);
    }
}
