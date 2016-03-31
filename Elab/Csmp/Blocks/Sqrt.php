<?php
/**
 * Class Sqrt
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\CalculationException;

/**
 * Kvadratni koren ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Sqrt extends Block
{
    protected $sign = "H";
    protected $description = "Kvadratni koren";
    protected $className = "Sqrt";
    protected $info = "Kvadratni koren, O=sqrt(E1)";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result < 0) {
            throw new CalculationException("Ulaz u kvadratni koren je negativan.");
        }
        $this->result = sqrt($this->inputs[0]->result);
    }
}
