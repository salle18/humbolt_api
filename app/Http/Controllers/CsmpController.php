<?php

namespace App\Http\Controllers;

use Elab\Csmp\Config as CsmpConfig;
use Elab\Csmp\Exceptions\CsmpException;
use Elab\Csmp\Exceptions\QuitSimulationException;
use Elab\Csmp\Simulation;
use Illuminate\Http\Request;

class CsmpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function simulate(Request $request)
    {
        $simulation = new Simulation();
        $simulation->loadJSON($request->all());
        try {
            $simulation->run();
            return response()->json($simulation->getSimulationResults());
        } catch (QuitSimulationException $e) {
            return response()->json($simulation->getSimulationResults());
        } catch (CsmpException $e) {
            return response()->json(["error" => $e->getMessage()]);
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
        //
    }

    public function show($id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
