<?php

use Elab\Csmp\Blocks\Add;

class AddTest extends CsmpTest
{

    public function testWithoutParams()
    {
        $block = new Add();
        $block->inputs[0] = $this->createConstant(1);
        $block->inputs[1] = $this->createConstant(2);
        $block->inputs[2] = $this->createConstant(3);
        $block->calculateResult();
        $this->assertEquals(0, $block->result);
    }

    public function testWithParams()
    {
        $block = new Add();
        $block->inputs[0] = $this->createConstant(1);
        $block->inputs[1] = $this->createConstant(2);
        $block->inputs[2] = $this->createConstant(3);
        $block->params[0] = -1;
        $block->params[1] = 2;
        $block->params[2] = -3;
        $block->calculateResult();
        $this->assertEquals(-6, $block->result);
    }

    public function testPartialInputs()
    {
        $block = new Add();
        $block->inputs[0] = $this->createConstant(1);
        $block->inputs[1] = $this->createConstant(2);
        $block->params[0] = -1;
        $block->params[1] = 2;
        $block->params[2] = -3;
        $block->calculateResult();
        $this->assertEquals(3, $block->result);
    }
}
