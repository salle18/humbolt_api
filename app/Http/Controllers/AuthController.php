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
        $name = $request->input("name");
        $password = $request->input("password");
        $response = $this->client->request("POST", $this->moodle_uri, [
            "verify" => false,
            "form_params" => [
                "username" => $name,
                "password" => $password,
                "service" => "moodle_mobile_app"
            ]
        ]);
        $body = json_decode($response->getBody());
        if ($body->token) {
            if (is_null($user = User::where("name", $name))) {
                $user = $this->create_user($name);
                $token = JWTAuth::fromUser($user);
                return response()->json(["token" => $token]);
            }
        } else {
            return $body;
        }
    }

    protected function create_user($name)
    {
        return User::create(["name" => $name]);
    }
}
