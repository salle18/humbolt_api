<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Sabira ulazne blokove i množi ih sa respektivinim parametrima.
 */
class Add extends Block
{
    protected $sign = "+";
    protected $description = "Sabirač";
    protected $className = "Add";
    protected $info = "Sabirač, O=P1*E1+P2*2+P3*E3";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 3;

    public function calculateResult()
    {
        $this->result = $this->params[0] * $this->inputs[0]->result + $this->params[1] * $this->inputs[1]->result + $this->params[2] * $this->inputs[2]->result;
    }
}
