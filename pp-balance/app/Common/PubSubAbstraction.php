<?php

namespace App\Common;

use Illuminate\Support\Facades\Http;

class PubSubAbstraction
{
    /** Esse processo seria assíncrono, disparado pelo próprio PubSub do GCP,
     * como essa classe representa uma abstração do mesmo, o processo fica travado
     * aguardando a execução do disparo.
     *
     * O "disparo" do método run é a representação do tópico "transaction-executed",
     * onde irá executar a verificação de saldo e transferência entre carteiras.
     *
     * @param int $status
     * @param int $transaction_id
     * @param int $payee
     */
    public function run(int $status, int $transaction_id, int $payee): void
    {
        // Http::post(env('CONFIG_URL_MS_BALANCE'), $transaction);
    }
}