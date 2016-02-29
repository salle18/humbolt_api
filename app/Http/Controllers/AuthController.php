<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{

    private $client;

    private $moodle_uri = "https://moodle.elab.fon.bg.ac.rs/login/token.php";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function login(Request $request)
    {
        $response = $this->client->request("POST", $this->moodle_uri, [
            "verify" => false,
            "form_params" => [
                "username" => $request->input("name"),
                "password" => $request->input("password"),
                "service" => "moodle_mobile_app"
            ]
        ]);
        return $response->getBody();
    }
}
