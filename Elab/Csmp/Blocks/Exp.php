<?php
/**
 * Class Exp
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Eksponent ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Exp extends Block
{
    protected $sign = "E";
    protected $description = "Exp";
    protected $className = "Exp";
    protected $info = "Eksponencijalna funkcija, O=P1*e^(P2*E1+P3)";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->params[0] * exp($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
