<?php

namespace App\Http\Controllers;

use App\Domain\Check\GetStatus;
use App\Models\Transactions;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required'
        ]);

        try {
            $transaction = $this->getTransaction($request->transaction_id);
            $status = (new GetStatus)->run($transaction->status);

            return response()->json([
                'transaction_id' => $request->transaction_id,
                'status' => $status
            ]);
        } catch (HttpException $e) {
            return response()->json(['Error' => $e->getMessage()], $e->getStatusCode());
        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 422);
        }
    }

    private function getTransaction($transaction_id)
    {
        $transaction = Transactions::find($transaction_id);

        if (empty($transaction)) {
            abort(404, 'Transaction not found');
        }

        return $transaction;
    }

}