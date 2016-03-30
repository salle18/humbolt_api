<?php

use Elab\Csmp\Blocks\Constant;

class ConstantTest extends CsmpTest
{

    public function testWithouInit()
    {
        $block = new Constant();
        $block->setParam(0, 5);
        $block->calculateResult();
        $this->assertEquals(0, $block->getResult());
    }

    public function testInit()
    {
        $block = new Constant();
        $block->setParam(0, 5);
        $block->init();
        $this->assertEquals(5, $block->getResult());
    }

    public function testCalculateResult()
    {
        $block = new Constant();
        $block->setParam(0, 5);
        $block->init();
        $block->setParam(0, 6);
        $block->calculateResult();
        $this->assertEquals(5, $block->getResult());
    }

}