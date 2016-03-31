<?php
/**
 * Class Amplify
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Pojačanje ulaza zadatim parametrom.
 *
 * @package Elab\Csmp\Blocks
 */
class Amplify extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "G";
    /**
     * {@inheritdoc}
     */
    protected $description = "Pojačanje";
    /**
     * {@inheritdoc}
     */
    protected $className = "Amplify";
    /**
     * {@inheritdoc}
     */
    protected $info = "Pojačanje, O=P1*E1";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 1;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 1;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        $this->result = $this->params[0] * $this->inputs[0]->result;
    }
}
