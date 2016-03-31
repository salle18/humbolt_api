<?php
/**
 * Class ArcTan
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Arkus tangens ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class ArcTan extends Block
{
    protected $sign = "A";
    protected $description = "ArcTan";
    protected $className = "ArcTan";
    protected $info = "Arkus tangens, O=P1*arctan(P2*E1+P3)";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->params[0] * atan($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
