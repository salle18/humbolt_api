<?php

use Elab\Csmp\Blocks\Constant;

abstract class CsmpTest extends PHPUnit_Framework_TestCase
{
    protected function constant($value)
    {
        $block = new Constant();
        $block->setParam(0, $value);
        $block->init();
        return $block;
    }

}