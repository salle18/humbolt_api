<?php

namespace Elab\Gpss;

use GuzzleHttp\Client;

class Simulation
{

    private $client;
    private $uri = 'http://localhost:9001';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function run($data)
    {
        $response = $this->client->post($this->uri, [
            'form_params' => ['gpss' => $this->parse($data)]
        ]);
        return $response->getBody()->getContents();
    }

    private function parse($data)
    {
        return str_replace("\n", "#", $data);
    }

}