<?php

use Elab\Csmp\Blocks\Wye;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Class WyeTest
 */
class WyeTest extends CsmpTest
{
    public function testCalculateResult()
    {
        $this->setExpectedException(NotImplementedException::class);
        $block = new Wye();
        $block->init();
    }

}