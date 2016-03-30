<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class CircuitDelay
 * Ukoliko je ulaz manji od nule vraća 0, ukoliko je veći od 0 vraća ulaz i pamti vrednost,
 * a ukoliko je nula vraća zapamćenu vrednost.
 *
 * @package Elab\Csmp\Blocks
 */
class CircuitDelay extends Block
{
    protected $sign = "Z";
    protected $description = "Kolo zadrške";
    protected $className = "CircuitDelay";
    protected $info = "Kolo zadrške, O=0 za E2<0, O=E1 za E2>0 i memoriše se vrednost, inače je memorisana vrednost";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 2;

    public function calculateResult()
    {
        if ($this->inputs[1]->result < 0) {
            $this->result = 0;
        } else if ($this->inputs[1]->result > 0) {
            $this->result = $this->inputs[0]->result;
            $this->memory = $this->result;
        } else {
            $this->result = $this->memory;
        }
    }
}
