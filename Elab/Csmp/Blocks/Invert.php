<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Invert
 * Invertuje znak ulaza.
 *
 * @package Elab\Csmp\Blocks
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
