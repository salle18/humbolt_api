<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Znak ulaza.
 */
class Sign extends Block
{
    protected $sign = "B";
    protected $description = "Sign";
    protected $className = "Sign";
    protected $info = "Znak ulaza, O=sgn(E1)";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result > 0) {
            $this->result = 1;
        } else if ($this->inputs[0]->result < 0) {
            $this->result = -1;
        } else {
            $this->result = 0;
        }
    }
}
