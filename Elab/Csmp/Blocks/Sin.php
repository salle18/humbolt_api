<?php
/**
 * Class Sin
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Sinus ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Sin extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "S";
    /**
     * {@inheritdoc}
     */
    protected $description = "Sin";
    /**
     * {@inheritdoc}
     */
    protected $className = "Sin";
    /**
     * {@inheritdoc}
     */
    protected $info = "Sinus, O=P1*sin(P2*E1+P3)";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 3;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 1;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        $this->result = $this->params[0] * sin($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
