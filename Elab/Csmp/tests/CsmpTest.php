<?php

use Elab\Csmp\Blocks\Constant;

abstract class CsmpTest extends PHPUnit_Framework_TestCase
{
    protected function createConstant($value)
    {
        $block = new Constant();
        $block->params[0] = $value;
        $block->init();
        return $block;
    }

}