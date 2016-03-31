<?php

use Elab\Csmp\Blocks\Vacuous;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Class VacuousTest
 */
class VacuousTest extends CsmpTest
{
    public function testCalculateResult()
    {
        $this->setExpectedException(NotImplementedException::class);
        $block = new Vacuous();
        $block->init();
    }
}