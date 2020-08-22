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
        UserTypes::firstOrCreate([
            "id" => 1,
            "description" => "COMUM"
        ]);

        UserTypes::firstOrCreate([
            "id" => 2,
            "description" => "LOJISTA"
        ]);
    }
}
