<?php

use Elab\Csmp\Blocks\Add;

/**
 * Class AddTest
 */
class AddTest extends CsmpTest
{

    public function testWithoutParams()
    {
        $block = new Add();
        $block->setInput(0, $this->constant(1));
        $block->setInput(1, $this->constant(2));
        $block->setInput(2, $this->constant(3));
        $block->calculateResult();
        $this->assertEquals(0, $block->getResult());
    }

    public function testWithParams()
    {
        $block = new Add();
        $block->setInput(0, $this->constant(1));
        $block->setInput(1, $this->constant(2));
        $block->setInput(2, $this->constant(3));
        $block->setParam(0, -1);
        $block->setParam(1, 2);
        $block->setParam(2, -3);
        $block->calculateResult();
        $this->assertEquals(-6, $block->getResult());
    }

    public function testPartialInputs()
    {
        $block = new Add();
        $block->setInput(0, $this->constant(1));
        $block->setInput(1, $this->constant(2));
        $block->setParam(0, -1);
        $block->setParam(1, 2);
        $block->setParam(2, -3);
        $block->calculateResult();
        $this->assertEquals(3, $block->getResult());
    }
}
