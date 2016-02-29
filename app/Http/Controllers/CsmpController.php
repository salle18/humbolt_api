<?php

namespace App\Http\Controllers;

use Elab\Csmp\Config;

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

    public function simulate()
    {
        //
    }

    public function blocks()
    {
        $config = new Config();
        $blocks = $config->blocks();
        return response()->json(array_map(function ($block) {
            return $block->getMetaJSON();
        }, $blocks));
    }

    public function methods()
    {
        $config = new Config();
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
