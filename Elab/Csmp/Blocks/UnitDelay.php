<?php
/**
 * Class UnitDelay
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Jedinično kašnjenje vraća rezulata iz prethodnog ciklusa izračunavanja.
 *
 * @package Elab\Csmp\Blocks
 */
class UnitDelay extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "U";
    /**
     * {@inheritdoc}
     */
    protected $description = "Jedinično kašnjenje";
    /**
     * {@inheritdoc}
     */
    protected $className = "UnitDelay";
    /**
     * {@inheritdoc}
     */
    protected $info = "Jedinično kašnjenje, O je prethodna vrednost E1";
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
    public function init()
    {
        $this->memory = $this->params[0];
    }

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        $this->result = $this->memory;
        $this->memory = $this->inputs[0]->result;
    }
}
