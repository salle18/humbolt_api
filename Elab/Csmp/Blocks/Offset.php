<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Offset dodaje parametar na ulaz.
 */
class Offset extends Block
{
    protected $sign = "O";
    protected $description = "Offset";
    protected $className = "Offset";
    protected $info = "Pomeraj, O=E1+P1";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->inputs[0]->result + $this->params[0];
    }
}
