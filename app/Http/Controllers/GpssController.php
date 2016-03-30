<?php

namespace App\Http\Controllers;

use App\GpssSimulation;
use Auth;
use Elab\Gpss\Simulation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GpssController extends Controller
{


    public function simulate(Request $request)
    {
        $data = $request->input('data');
        $simulation = new Simulation();
        $results = $simulation->run($data);
        return response($results, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function index()
    {
        $user = Auth::user();
        $simulations = $user->gpsssimulations()->get(['id', 'description', 'created_at']);
        return response()->json($simulations);
    }

    public function show($id)
    {
        $user = Auth::user();
        $simulation = $user->gpsssimulations()->where('id', $id)->first(['data']);
        /**
         * Pošto već čuvamo json podatke ne treba ih ponovo enkodovati.
         * Zato vraćamo raw response sa postavljenim zaglavljem za json.
         */
        return response($simulation['data'], Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $simulation = new GpssSimulation([
            'description' => $data['description'],
            'data' => json_encode($data)
        ]);
        $simulation->user_id = $user->id;
        $simulation->save();
        return response()->json(['_id' => $simulation->id]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $user->gpsssimulations()->where('id', $id)->delete();
        return response()->json(['deleted' => $id]);
    }
}
