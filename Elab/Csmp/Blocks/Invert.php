<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Invertuje znak ulaza.
 */
class Invert extends Block
{
    protected $sign = "-";
    protected $description = "Invertor";
    protected $className = "Invert";
    protected $info = "Invertor, O=-E1";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = -$this->inputs[0]->result;
    }
}
