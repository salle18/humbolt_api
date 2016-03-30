<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class DeadZone
 * Mrtva zona. Ako se ulaz ne nalazi između parametara vraća 0.
 *
 * @package Elab\Csmp\Blocks
 */
class DeadZone extends Block
{
    protected $sign = "D";
    protected $description = "Mrtva zona";
    protected $className = "DeadZone";
    protected $info = "Mrtva zona, O=0 za P1<E1<P2";
    protected $numberOfParams = 2;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result > $this->params[0] && $this->inputs[0]->result < $this->params[1]) {
            $this->result = 0;
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
