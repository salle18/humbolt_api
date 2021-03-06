<?php
/**
 * Class DeadZone
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Mrtva zona. Ako se ulaz ne nalazi između parametara vraća 0.
 *
 * @package Elab\Csmp\Blocks
 */
class DeadZone extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "D";
    /**
     * {@inheritdoc}
     */
    protected $description = "Mrtva zona";
    /**
     * {@inheritdoc}
     */
    protected $className = "DeadZone";
    /**
     * {@inheritdoc}
     */
    protected $info = "Mrtva zona, O=0 za P1<E1<P2";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 2;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 1;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        if ($this->inputs[0]->result > $this->params[0] && $this->inputs[0]->result < $this->params[1]) {
            $this->result = 0;
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
