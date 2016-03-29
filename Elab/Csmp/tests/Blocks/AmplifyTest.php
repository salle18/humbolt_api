<?php

use Elab\Csmp\Blocks\Amplify;

class AmplifyTest extends CsmpTest
{

    public function testPositiveParam()
    {
        $block = new Amplify();
        $block->inputs[0] = $this->createConstant(2);
        $block->params[0] = 5;
        $block->calculateResult();
        $this->assertEquals(10, $block->result);
    }

    public function testNegativeParam()
    {
        $block = new Amplify();
        $block->inputs[0] = $this->createConstant(3);
        $block->params[0] = -5;
        $block->calculateResult();
        $this->assertEquals(-15, $block->result);
    }

    public function testWithoutParam()
    {
        $block = new Amplify();
        $block->inputs[0] = $this->createConstant(5);
        $block->calculateResult();
        $this->assertEquals(0, $block->result);
    }
}