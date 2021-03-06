<?php
/**
 * Class Sign
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Znak ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Sign extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "B";
    /**
     * {@inheritdoc}
     */
    protected $description = "Sign";
    /**
     * {@inheritdoc}
     */
    protected $className = "Sign";
    /**
     * {@inheritdoc}
     */
    protected $info = "Znak ulaza, O=sgn(E1)";
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
        if ($this->inputs[0]->result > 0) {
            $this->result = 1;
        } else if ($this->inputs[0]->result < 0) {
            $this->result = -1;
        } else {
            $this->result = 0;
        }
    }
}
