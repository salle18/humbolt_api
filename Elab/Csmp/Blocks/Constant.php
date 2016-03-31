<?php
/**
 * Class Constant
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Konstanta, uvek vraća vrednost prvog parametra.
 *
 * @package Elab\Csmp\Blocks
 */
class Constant extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "K";
    /**
     * {@inheritdoc}
     */
    protected $description = "Konstanta";
    /**
     * {@inheritdoc}
     */
    protected $className = "Constant";
    /**
     * {@inheritdoc}
     */
    protected $info = "Konstanta, O=P1";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 1;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 0;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->result = $this->params[0];
    }
}
