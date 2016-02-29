<?php

namespace Elab\Csmp;

use GuzzleHttp\Client;

class IoTService
{

    private $block;
    private $client;

    public function __construct(Block $block)
    {
        $this->block = $block;
        $this->client = new Client();
    }

    /**
     * Poziva web servis i upisuje rezultat u rezultat izračunavanja bloka.
     *
     * @return Promise objekat
     */
    public function load()
    {
        $params = [
            "params" => $this->block->params,
            "inputs" => array_map(function ($block) {
                return $block->result;
            }, $this->block->inputs),
            "connections" => array_map(function ($block, $index) {
                return is_a($block, EmptyBlock::class) ? -1 : $index;
            }, $this->block->inputs),
            "time" => $this->block->getSimulation()->getTimer()
        ];
       $response = $this->client->request("GET", $this->block->stringParams[0], [
            "query" => $params
        ]);
        return $response->getBody();
    }


}
