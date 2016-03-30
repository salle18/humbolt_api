<?php

namespace Elab\Csmp;

use Elab\Csmp\Exceptions\IoTException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class IoTService
{

    /**
     * @var Block IoT blok za koji se poziva web servis.
     */
    private $block;
    /**
     * @var Client
     */
    private $client;

    public function __construct(Block $block)
    {
        $this->block = $block;
        $this->client = new Client();
    }

    /**
     * Poziva web servis i vraća rezultat izračunavanja bloka.
     *
     * @throws IoTException
     * @return float
     */
    public function load()
    {
        $params = [
            "params" => $this->block->getParams(),
            "inputs" => array_map(function ($block) {
                return $block->result;
            }, $this->block->getInputs()),
            "connections" => array_map(function ($block) {
                return !is_a($block, EmptyBlock::class);
            }, $this->block->getInputs()),
            "time" => $this->block->getSimulation()->getTimer()
        ];
        try {
            $response = $this->client->request("GET", $this->block->getStringParam(0), [
                "query" => $params
            ]);
        } catch (RequestException $e) {
            throw new IoTException("Greška prilikom konekcije na web servis IoT elementa.");
        }

        return (float)$response->getBody()->getContents();
    }

}
