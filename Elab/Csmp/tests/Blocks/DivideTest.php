<?php

use Elab\Csmp\Blocks\Divide;
use Elab\Csmp\Exceptions\CalculationException;

/**
 * Class DivideTest
 */
class DivideTest extends CsmpTest
{

    public function testCalculateResult()
    {
        $block = new Divide();
        $block->setInput(0, $this->constant(5.2));
        $block->setInput(1, $this->constant(3));
        $block->calculateResult();
        $result = 5.2 / (float)3;
        $this->assertEquals($result, $block->getResult());
    }

    public function testZeroException()
    {
        $this->setExpectedException(CalculationException::class);
        $block = new Divide();
        $block->setInput(0, $this->constant(5));
        $block->setInput(1, $this->constant(0));
        $block->calculateResult();
    }
}