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
        $response = $this->client->request('POST', $this->uri, [
            'form_data' => $data
        ]);
        return $response->getBody()->getContents();
    }

}