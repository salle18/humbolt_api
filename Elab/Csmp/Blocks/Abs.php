<?php
/**
 * Class Abs
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Apsolutna vrednost ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Abs extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "M";
    /**
     * {@inheritdoc}
     */
    protected $description = "Apsolutna vrednost";
    /**
     * {@inheritdoc}
     */
    protected $className = "Abs";
    /**
     * {@inheritdoc}
     */
    protected $info = "Apsolutna vrednost O=|E1|";
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
        $this->result = abs($this->inputs[0]->result);
    }
}
