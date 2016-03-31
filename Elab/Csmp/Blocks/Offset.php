<?php
/**
 * Class Offset
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Offset dodaje parametar na ulaz.
 *
 * @package Elab\Csmp\Blocks
 */
class Offset extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "O";
    /**
     * {@inheritdoc}
     */
    protected $description = "Offset";
    /**
     * {@inheritdoc}
     */
    protected $className = "Offset";
    /**
     * {@inheritdoc}
     */
    protected $info = "Pomeraj, O=E1+P1";
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
        $this->result = $this->inputs[0]->result + $this->params[0];
    }
}
