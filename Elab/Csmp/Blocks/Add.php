<?php
/**
 * Class Add
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Sabira ulazne blokove i množi ih sa respektivinim parametrima.
 *
 * @package Elab\Csmp\Blocks
 */
class Add extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "+";
    /**
     * {@inheritdoc}
     */
    protected $description = "Sabirač";
    /**
     * {@inheritdoc}
     */
    protected $className = "Add";
    /**
     * {@inheritdoc}
     */
    protected $info = "Sabirač, O=P1*E1+P2*2+P3*E3";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 3;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 3;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        $this->result = $this->params[0] * $this->inputs[0]->result + $this->params[1] * $this->inputs[1]->result + $this->params[2] * $this->inputs[2]->result;
    }
}
