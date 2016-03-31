<?php
/**
 * Class Exp
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Eksponent ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Exp extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "E";
    /**
     * {@inheritdoc}
     */
    protected $description = "Exp";
    /**
     * {@inheritdoc}
     */
    protected $className = "Exp";
    /**
     * {@inheritdoc}
     */
    protected $info = "Eksponencijalna funkcija, O=P1*e^(P2*E1+P3)";
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
        $this->result = $this->params[0] * exp($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
