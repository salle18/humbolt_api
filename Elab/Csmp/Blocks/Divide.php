<?php
/**
 * Class Divide
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\CalculationException;

/**
 * Deli ulaze.
 *
 * @package Elab\Csmp\Blocks
 */
class Divide extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "/";
    /**
     * {@inheritdoc}
     */
    protected $description = "Delitelj";
    /**
     * {@inheritdoc}
     */
    protected $className = "Divide";
    /**
     * {@inheritdoc}
     */
    protected $info = "Delitelj, O=E1/E2";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 0;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 2;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        if ($this->inputs[1]->result === 0 || $this->inputs[1]->result === 0.0) {
            throw new CalculationException("Divider nedozvoljeno deljenje nulom.");
        }
        $this->result = $this->inputs[0]->result / (float)$this->inputs[1]->result;
    }
}
