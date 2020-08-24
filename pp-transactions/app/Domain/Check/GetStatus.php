<?php

namespace App\Domain\Check;

use App\Common\Enum\TransactionStatus;

class GetStatus
{
    public function run($status): array
    {
        $transactionStatus['number'] = $status;
        switch ($status) {
            case TransactionStatus::STARTED:
                $transactionStatus['description'] = "Started";
                break;
            case TransactionStatus::DONE:
                $transactionStatus['description'] = "Done";
                break;
            case TransactionStatus::ERROR:
                $transactionStatus['description'] = "Error";
                break;
        }
        return $transactionStatus;
    }
}