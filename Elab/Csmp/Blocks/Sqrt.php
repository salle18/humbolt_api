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
    /**
     * {@inheritdoc}
     */
    protected $sign = "H";
    /**
     * {@inheritdoc}
     */
    protected $description = "Kvadratni koren";
    /**
     * {@inheritdoc}
     */
    protected $className = "Sqrt";
    /**
     * {@inheritdoc}
     */
    protected $info = "Kvadratni koren, O=sqrt(E1)";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 0;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 1;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        if ($this->inputs[0]->result < 0) {
            throw new CalculationException("Ulaz u kvadratni koren je negativan.");
        }
        $this->result = sqrt($this->inputs[0]->result);
    }
}
