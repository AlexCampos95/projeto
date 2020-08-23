<?php

namespace App\Common\PubSub;

use Illuminate\Support\Facades\Http;

/** Esse processo seria assíncrono, disparado pelo próprio PubSub do GCP,
 * como essa classe representa uma abstração do mesmo, o processo fica travado
 * aguardando a execução do disparo.
 *
 */
class PubSubAbstraction
{
    private $url;
    private $data;

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function run(): void
    {
        Http::post($this->url, $this->data);
    }


}