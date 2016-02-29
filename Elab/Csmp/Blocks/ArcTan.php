<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\CalculationException;

/**
 * Arkus tangens ulaza.
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
        $check = $this->params[1] * $this->inputs[0]->result + $this->params[2];
        if ($check > 0) {
            $this->result = $this->params[0] * atan($check);
        } else {
            throw new CalculationException("Vrednost za ArcTan je negativna.");
        }
    }
}
