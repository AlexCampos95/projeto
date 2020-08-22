<?php

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::firstOrCreate([
            'user_id' => 1,
            'balance' => 100
        ]);

        Wallet::firstOrCreate([
            'user_id' => 2,
            'balance' => 200
        ]);

        Wallet::firstOrCreate([
            'user_id' => 3,
            'balance' => 300
        ]);

        Wallet::firstOrCreate([
            'user_id' => 4,
            'balance' => 250
        ]);

        Wallet::firstOrCreate([
            'user_id' => 5,
            'balance' => 10
        ]);
    }
}
