<?php

namespace App\Common\PubSub\Shooter;

use App\Common\PubSub\PubSubAbstraction;

class ShootPubSub
{
    /**
     * O "disparo" do método run é a representação do tópico "transaction-executed",
     * onde irá executar a verificação de saldo e transferência entre carteiras.
     *
     * @param array $transaction
     */
    public function transactionCreatedRun(array $transaction)
    {
        $data['transaction_id'] = $transaction['id'];
        $data['payee'] = $transaction['payee'];
        $data['payer'] = $transaction['payer'];
        $data['value'] = $transaction['value'];

        $transferDoneTopic = new PubSubAbstraction();
        $transferDoneTopic->setUrl(env('CONFIG_URL_MS_BALANCE'));
        $transferDoneTopic->setData($data);
        $transferDoneTopic->run();
    }
}