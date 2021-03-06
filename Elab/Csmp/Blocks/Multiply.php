<?php
/**
 * Class Multiply
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Množi ulaze.
 *
 * @package Elab\Csmp\Blocks
 */
class Multiply extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "*";
    /**
     * {@inheritdoc}
     */
    protected $description = "Množač";
    /**
     * {@inheritdoc}
     */
    protected $className = "Multiply";
    /**
     * {@inheritdoc}
     */
    protected $info = "Množač, О=E1*E2";
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
        $this->result = $this->inputs[0]->result * $this->inputs[1]->result;
    }
}
