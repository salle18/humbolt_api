<?php

namespace App\Http\Controllers;

use App\Contracts\AuthServiceContract;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;


class AuthController extends Controller
{

    public function login(Request $request, AuthServiceContract $authService)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        $response = $authService->authenticate($name, $password);

        if (isset($response["token"])) {
            if (is_null($user = User::where("name", $name)->first())) {
                $user = $this->create_user($name);
            }
            $token = JWTAuth::fromUser($user);
            return response()->json(["token" => $token]);
        } else {
            return response()->json($response);
        }
    }

    protected function create_user($name)
    {
        $user = User::create(["name" => $name]);
        $seeder = new \CsmpSimulationsTableSeeder();
        $seeder->predefinedSimulations($user);
        return $user;
    }
}
