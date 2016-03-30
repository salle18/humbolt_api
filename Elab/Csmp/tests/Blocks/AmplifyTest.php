<?php

use Elab\Csmp\Blocks\Amplify;

class AmplifyTest extends CsmpTest
{

    public function testPositiveParam()
    {
        $block = new Amplify();
        $block->setInput(0, $this->constant(2));
        $block->setParam(0, 5);
        $block->calculateResult();
        $this->assertEquals(10, $block->getResult());
    }

    public function testNegativeParam()
    {
        $block = new Amplify();
        $block->setInput(0, $this->constant(3));
        $block->setParam(0, -5);
        $block->calculateResult();
        $this->assertEquals(-15, $block->getResult());
    }

    public function testWithoutParam()
    {
        $block = new Amplify();
        $block->setInput(0, $this->constant(5));
        $block->calculateResult();
        $this->assertEquals(0, $block->getResult());
    }
}