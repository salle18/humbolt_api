<?php
/**
 * Class ArcTan
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Arkus tangens ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class ArcTan extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "A";
    /**
     * {@inheritdoc}
     */
    protected $description = "ArcTan";
    /**
     * {@inheritdoc}
     */
    protected $className = "ArcTan";
    /**
     * {@inheritdoc}
     */
    protected $info = "Arkus tangens, O=P1*arctan(P2*E1+P3)";
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
        $this->result = $this->params[0] * atan($this->params[1] * $this->inputs[0]->result + $this->params[2]);
    }
}
