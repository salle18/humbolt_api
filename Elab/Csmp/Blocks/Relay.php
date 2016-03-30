<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Relay
 * Vraća drugi ili treći ulaz zavisno da li je prvi ulaz veći od nule.
 *
 * @package Elab\Csmp\Blocks
 */
class Relay extends Block
{
    protected $sign = "R";
    protected $description = "Relej";
    protected $className = "Relay";
    protected $info = "Relej, O=E3 za E1<0, inače O=E2";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 3;

    public function calculateResult()
    {
        if ($this->inputs[0]->result < 0) {
            $this->result = $this->inputs[2]->result;
        } else {
            $this->result = $this->inputs[1]->result;
        }
    }
}
