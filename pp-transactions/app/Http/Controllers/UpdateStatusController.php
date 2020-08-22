<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UpdateStatusController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required',
            'status' => 'required'
        ]);

        $transactions = Transactions::find($request->transaction_id);
        $transactions->status = $request->status;
        $transactions->save();
    }
}