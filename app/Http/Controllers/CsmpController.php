<?php

namespace App\Http\Controllers;

use App\CsmpSimulation;
use Auth;
use Elab\Csmp\Config as CsmpConfig;
use Elab\Csmp\Exceptions\CsmpException;
use Elab\Csmp\Exceptions\QuitSimulationException;
use Elab\Csmp\Simulation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CsmpController extends Controller
{

    public function simulate(Request $request)
    {
        $data = $request->all();
        $simulation = new Simulation();
        $simulation->loadJSON($data);
        try {
            $simulation->run();
            return response()->json($simulation->getSimulationResults());
        } catch (QuitSimulationException $e) {
            return response()->json($simulation->getSimulationResults());
        } catch (CsmpException $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function blocks()
    {
        $config = new CsmpConfig();
        $blocks = $config->blocks();
        return response()->json(array_map(function ($block) {
            return $block->getMetaJSON();
        }, $blocks));
    }

    public function methods()
    {
        $config = new CsmpConfig();
        $methods = $config->methods();
        return response()->json(array_map(function ($method) {
            return $method->getMetaJSON();
        }, $methods));
    }

    public function index()
    {
        $user = Auth::user();
        $simulations = $user->csmpsimulations()->get(['id', 'description', 'created_at']);
        return response()->json($simulations);
    }

    public function show($id)
    {
        $user = Auth::user();
        $data = $user->csmpsimulations()->first(['data']);
        return response($data['data'], Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $simulation = new CsmpSimulation([
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
        $user->csmpsimulations()->where('id', $id)->delete();
        return response()->json(['deleted' => $id]);
    }
}
