<?php

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::firstOrCreate([
            "name" => "jose santos",
            "email" => "jose.email@email",
            "user_types_id" => 1,
            "password" => Hash::make('123'),
            "cpf_cnpj" => 97172412010
        ]);

        Users::firstOrCreate([
            "name" => "manuel santos",
            "email" => "manuel.santos@email",
            "user_types_id" => 1,
            "password" => Hash::make('123'),
            "cpf_cnpj" => 23809496030
        ]);

        Users::firstOrCreate([
            "name" => "antonio santos",
            "email" => "antonio.santos@email",
            "user_types_id" => 1,
            "password" => Hash::make('123'),
            "cpf_cnpj" => 36382239062
        ]);


        Users::firstOrCreate([
            "name" => "santos calçados",
            "email" => "santos.calcados@email",
            "user_types_id" => 2,
            "password" => Hash::make('123'),
            "cpf_cnpj" => 76263673000104
        ]);

        Users::firstOrCreate([
            "name" => "Beer chopp",
            "email" => "beer.chopp@email",
            "user_types_id" => 2,
            "password" => Hash::make('123'),
            "cpf_cnpj" => 21567801000103
        ]);
    }
}
