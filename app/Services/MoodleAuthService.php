<?php

namespace App\Services;

use App\Contracts\AuthServiceContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MoodleAuthService implements AuthServiceContract
{

    protected $moodle_uri = "https://moodle.elab.fon.bg.ac.rs/login/token.php";
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function authenticate($username, $password)
    {
        try {
            $response = $this->client->request("POST", $this->moodle_uri, [
                "verify" => false,
                "form_params" => [
                    "username" => $username,
                    "password" => $password,
                    "service" => "moodle_mobile_app"
                ]
            ]);
        } catch (RequestException $e) {
            return [
                "error" => "Greška prilikom konekcije na moodle servis.",
                "stacktrace" => null,
                "debuginfo" => null,
                "reproductionlink" => null,
            ];
        }
        return json_decode($response->getBody(), true);
    }
}