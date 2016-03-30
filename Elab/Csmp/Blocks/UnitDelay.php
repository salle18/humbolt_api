<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class UnitDelay
 * Jedinično kašnjenje vraća rezulata iz prethodnog ciklusa izračunavanja.
 *
 * @package Elab\Csmp\Blocks
 */
class UnitDelay extends Block
{
    protected $sign = "U";
    protected $description = "Jedinično kašnjenje";
    protected $className = "UnitDelay";
    protected $info = "Jedinično kašnjenje, O je prethodna vrednost E1";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 1;

    public function init()
    {
        $this->memory = $this->params[0];
    }

    public function calculateResult()
    {
        $this->result = $this->memory;
        $this->memory = $this->inputs[0]->result;
    }
}
