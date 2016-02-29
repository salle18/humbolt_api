<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Generator slučajnih brojeva na intervalu [0, 1).
 */
class Randomizer extends Block
{
    protected $sign = "J";
    protected $description = "Random generator";
    protected $className = "Randomizer";
    protected $info = "Generator slučajnih brojeva, O između [0,1)";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 0;

    public function calculateResult()
    {
        $this->result = mt_rand() / mt_getrandmax();
    }
}
