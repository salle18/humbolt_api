<?php
/**
 * Class Invert
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Invertuje znak ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Invert extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "-";
    /**
     * {@inheritdoc}
     */
    protected $description = "Invertor";
    /**
     * {@inheritdoc}
     */
    protected $className = "Invert";
    /**
     * {@inheritdoc}
     */
    protected $info = "Invertor, O=-E1";
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
        $this->result = -$this->inputs[0]->result;
    }
}
