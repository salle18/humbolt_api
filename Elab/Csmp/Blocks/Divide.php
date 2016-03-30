<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\CalculationException;

/**
 * Class Divide
 * Deli ulaze.
 *
 * @package Elab\Csmp\Blocks
 */
class Divide extends Block
{
    protected $sign = "/";
    protected $description = "Delitelj";
    protected $className = "Divide";
    protected $info = "Delitelj, O=E1/E2";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 2;

    public function calculateResult()
    {
        if ($this->inputs[1]->result === 0) {
            throw new CalculationException("Divider nedozvoljeno deljenje nulom.");
        }
        $this->result = $this->inputs[0]->result / $this->inputs[1]->result;
    }
}
