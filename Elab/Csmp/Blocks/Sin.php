<?php
/**
 * Class Sin
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Sinus ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Sin extends Block
{
    protected $sign = "S";
    protected $description = "Sin";
    protected $className = "Sin";
    protected $info = "Sinus, O=P1*sin(P2*E1+P3)";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->params[0] * sin($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
