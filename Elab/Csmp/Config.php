<?php

namespace Elab\Csmp;

class Config
{
    public function blocks()
    {
        $block_classes = require "config/blocks.php";
        return array_map(function ($block_class) {
            return new $block_class();
        }, $block_classes);
    }

    public function methods()
    {
        $method_classes = require "config/methods.php";
        return array_map(function ($method_class) {
            return new $method_class();
        }, $method_classes);
    }

}