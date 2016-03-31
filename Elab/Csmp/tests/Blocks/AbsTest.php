<?php

use Elab\Csmp\Blocks\Abs;

/**
 * Class AbsTest
 */
class AbsTest extends CsmpTest
{

    public function testPositiveInput()
    {
        $block = new Abs();
        $block->setInput(0, $this->constant(1));
        $block->calculateResult();
        $this->assertEquals(1, $block->getResult());
    }

    public function testNegativeInput()
    {
        $block = new Abs();
        $block->setInput(0, $this->constant(-1));
        $block->calculateResult();
        $this->assertEquals(1, $block->getResult());
    }

    public function testZeroInput()
    {
        $block = new Abs();
        $block->setInput(0, $this->constant(0));
        $block->calculateResult();
        $this->assertEquals(0, $block->getResult());
    }
}
