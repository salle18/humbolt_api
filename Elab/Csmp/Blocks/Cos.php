<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Cos
 * Kosinus ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Cos extends Block
{
    protected $sign = "C";
    protected $description = "Cos";
    protected $className = "Cos";
    protected $info = "Kosinus, O=P1*cos(P2*E1+P3)";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->params[0] * cos($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
