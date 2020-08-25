<?php

namespace App\Http\Controllers;

use App\Common\Cache\Configs;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Lumen\Routing\Controller;

class UpdateStatusController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required',
            'status' => 'required'
        ]);

        $cacheKey = Configs::CHECK_PREFIX . $request->transaction_id;
        Cache::forget($cacheKey);

        $transactions = Transactions::find($request->transaction_id);
        $transactions->status = $request->status;
        $transactions->save();
    }
}