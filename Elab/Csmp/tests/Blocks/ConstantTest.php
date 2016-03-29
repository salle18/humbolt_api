<?php

use Elab\Csmp\Blocks\Constant;

class ConstantTest extends CsmpTest
{

    public function testWithouInit()
    {
        $block = new Constant();
        $block->params[0] = 5;
        $block->calculateResult();
        $this->assertEquals(0, $block->result);
    }

    public function testInit()
    {
        $block = new Constant();
        $block->params[0] = 5;
        $block->init();
        $this->assertEquals(5, $block->result);
    }

    public function testCalculateResult()
    {
        $block = new Constant();
        $block->params[0] = 5;
        $block->init();
        $block->params[1] = 6;
        $block->calculateResult();
        $this->assertEquals(5, $block->result);
    }

}