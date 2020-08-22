<?php

/** Classe fara a representação do PubSub,
 * o código executado nesse ponto seria assíncrono no mundo real
 * por conta da abstração com disparo Http será linear.
 *
 * O "disparo" do método run é a representação do tópico "user-created",
 * onde irá executar a criação da carteira do mesmo.
 */
class PubSubAbstraction
{
    public function run()
    {
        //Do some code
    }
}