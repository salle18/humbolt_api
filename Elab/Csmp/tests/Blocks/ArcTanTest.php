<?php

use Elab\Csmp\Blocks\ArcTan;

class ArcTanTest extends CsmpTest
{

    public function testCalculateResult()
    {
        $block = new ArcTan();
        $block->setInput(0, $this->constant(5));
        $block->setParam(0, 2);
        $block->setParam(1, 3);
        $block->setParam(2, 4);
        $block->calculateResult();
        $result = 2 * atan(3 * 5 + 4);
        $this->assertEquals($result, $block->getResult());
    }

}
