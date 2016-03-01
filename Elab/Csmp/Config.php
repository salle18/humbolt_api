<?php

namespace Elab\Csmp;

use Elab\Csmp\Exceptions\BlockNotFoundException;
use Elab\Csmp\Exceptions\MethodNotFoundException;

class Config
{

    private $block_classes;

    private $method_classes;

    public function __construct()
    {
        $this->block_classes = require "config/blocks.php";
        $this->method_classes = require "config/methods.php";
    }

    public function blocks()
    {
        return array_map(function ($block_class) {
            return new $block_class();
        }, $this->block_classes);
    }

    public function methods()
    {
        return array_map(function ($method_class) {
            return new $method_class();
        }, $this->method_classes);
    }

    public function getMethod($method, $simulation = null)
    {
        $key = array_search($method, $this->method_classes);
        if ($key !== false) {
            return new $this->method_classes[$key]($simulation);
        }
        throw new MethodNotFoundException("Nije pronađena metoda integracije.");
    }

    public function getBlock($block)
    {
        $key = array_search($block, $this->block_classes);
        if ($key !== false) {
            return new $this->block_classes[$key]();
        }
        throw new BlockNotFoundException("Nije pronađena implementacija datog bloka.");

    }

}