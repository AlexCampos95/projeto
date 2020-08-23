<?php

namespace App\Http\Controllers;

use App\Domain\AddFounds\ValidateAmount;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class AddFundsController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required'
        ]);

        try {
            (new ValidateAmount())->run($request->amount);

            $wallet = Wallet::firstOrNew(['user_id' => $request->user_id]);
            $balance = $request->amount + $wallet->balance;

            $wallet->fill(['balance' => $balance]);
            $wallet->save();
            return response()->json($wallet);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 412);
        }
    }
}