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
        return response()->json($results);
    }

    public function index()
    {
        $user = Auth::user();
        return response()->json($user->gpsssimulations()->get(['id', 'description', 'created_at']));
    }

    public function show($id)
    {
        $user = Auth::user();
        $data = $user->gpsssimulations()->where('id', $id)->first(['data']);
        return response($data['data'], Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $simulation = GpssSimulation::create([
            'user_id' => $user->id,
            'description' => $data['description'],
            'data' => json_encode($data)
        ]);
        return response()->json(['_id' => $simulation->id]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $user->gpsssimulations()->where('id', $id)->delete();
        return response()->json(['deleted' => $id]);
    }
}
