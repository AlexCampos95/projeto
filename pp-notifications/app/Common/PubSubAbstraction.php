<?php

namespace App\Common;

/** Essa classe representa a abstração do PubSub no tópico "try-notify-again"
 * onde, quando há uma ionstabilidade no notificador externo a requisição
 * volta para a fila.
 *
 * Essa abstração não fara uma requisição, por se tratar de uma recurssão,
 * uma vez que a abstração do pubSub fica no próprio micro serviço.
 */
class PubSubAbstraction
{
    public function run()
    {
        return response()->json(['message' => 'Added to the queue again']);
    }
}