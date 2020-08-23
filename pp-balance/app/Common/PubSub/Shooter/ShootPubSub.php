<?php

namespace App\Common\PubSub\Shooter;

use App\Common\PubSub\PubSubAbstraction;

class ShootPubSub
{
    /**
     * O "disparo" do método transferDoneRun é a representação do tópico "transfer-done",
     * onde irá executar a notificação do usuário e upate do status da transação.
     *
     * @param int $status
     * @param int $transaction_id
     * @param int $payee
     */
    public function transferDoneRun(int $status, int $transaction_id, int $payee)
    {
        $data['status'] = $status;
        $data['transaction_id'] = $transaction_id;
        $data['user_id'] = $payee;

        $transferDoneTopic = new PubSubAbstraction();
        $transferDoneTopic->setUrl(env('CONFIG_URL_MS_NOTIFICATIONS'));
        $transferDoneTopic->setData($data);
        $transferDoneTopic->run();
    }
}