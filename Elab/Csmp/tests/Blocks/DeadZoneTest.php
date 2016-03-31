<?php

use Elab\Csmp\Blocks\DeadZone;

/**
 * Class DeadZoneTest
 */
class DeadZoneTest extends CsmpTest
{
    public function testInDeadZone()
    {
        $block = new DeadZone();
        $block->setInput(0, $this->constant(8));
        $block->setParam(0, 5);
        $block->setParam(1, 10);
        $block->calculateResult();
        $this->assertEquals(0, $block->getResult());
    }

    public function testOutDeadZone()
    {
        $block = new DeadZone();
        $block->setInput(0, $this->constant(-5));
        $block->setParam(0, 5);
        $block->setParam(1, 10);
        $block->calculateResult();
        $this->assertEquals(-5, $block->getResult());
    }

}