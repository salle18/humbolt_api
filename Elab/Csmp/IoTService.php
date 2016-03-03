<?php

namespace Elab\Csmp;

use Elab\Csmp\Exceptions\IoTException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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
            "connections" => array_map(function ($block) {
                return !is_a($block, EmptyBlock::class);
            }, $this->block->inputs),
            "time" => $this->block->getSimulation()->getTimer()
        ];
        try {
            $response = $this->client->request("GET", $this->block->stringParams[0], [
                "query" => $params
            ]);
        } catch (RequestException $e) {
            throw new IoTException("Greška prilikom konekcije na web servis IoT elementa.");
        }

        return (float)$response->getBody()->getContents();
    }

}
