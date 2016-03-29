<?php

use Elab\Csmp\Blocks\Abs;

class AbsTest extends CsmpTest
{

    public function testPositiveInput()
    {
        $block = new Abs();
        $block->inputs[0] = $this->createConstant(1);
        $block->calculateResult();
        $this->assertEquals(1, $block->result);
    }

    public function testNegativeInput()
    {
        $block = new Abs();
        $block->inputs[0] = $this->createConstant(-1);
        $block->calculateResult();
        $this->assertEquals(1, $block->result);
    }

    public function testZeroInput()
    {
        $block = new Abs();
        $block->inputs[0] = $this->createConstant(0);
        $block->calculateResult();
        $this->assertEquals(0, $block->result);
    }
}
