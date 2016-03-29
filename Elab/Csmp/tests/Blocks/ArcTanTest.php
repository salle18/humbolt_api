<?php

use Elab\Csmp\Blocks\ArcTan;

class ArcTanTest extends CsmpTest
{

    public function testCalculateResult()
    {
        $block = new ArcTan();
        $block->inputs[0] = $this->createConstant(5);
        $block->params[0] = 2;
        $block->params[1] = 3;
        $block->params[2] = 4;
        $block->calculateResult();
        $result = 2 * atan(3 * 5 + 4);
        $this->assertEquals($result, $block->result);
    }

}
