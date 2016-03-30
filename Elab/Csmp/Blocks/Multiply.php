<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Multiply
 * Množi ulaze.
 *
 * @package Elab\Csmp\Blocks
 */
class Multiply extends Block
{
    protected $sign = "*";
    protected $description = "Množač";
    protected $className = "Multiply";
    protected $info = "Množač, О=E1*E2";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 2;

    public function calculateResult()
    {
        $this->result = $this->inputs[0]->result * $this->inputs[1]->result;
    }
}
