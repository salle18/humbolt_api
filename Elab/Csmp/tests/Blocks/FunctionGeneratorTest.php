<?php

use Elab\Csmp\Blocks\FunctionGenerator;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Class FunctionGeneratorTest
 */
class FunctionGeneratorTest extends CsmpTest
{
    public function testCalculateResult()
    {
        $this->setExpectedException(NotImplementedException::class);
        $block = new FunctionGenerator();
        $block->init();
    }
}