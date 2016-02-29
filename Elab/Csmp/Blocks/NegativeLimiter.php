<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Negativni ograničavač vraća ulaz ukoliko je veći od nule, a nulu inače.
 */
class NegativeLimiter extends Block
{
    protected $sign = "N";
    protected $description = "Negativni ograničavač";
    protected $className = "NegativeLimiter";
    protected $info = "Negativni ograničavač, O=0 za E1<0, inače O=E1";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result < 0) {
            $this->result = 0;
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
