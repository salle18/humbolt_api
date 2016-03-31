<?php
/**
 * Class FunctionGenerator
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Generator funkcija nije implementiran.
 *
 * @package Elab\Csmp\Blocks
 */
class FunctionGenerator extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "F";
    /**
     * {@inheritdoc}
     */
    protected $description = "Generator funkcija";
    /**
     * {@inheritdoc}
     */
    protected $className = "FunctionGenerator";
    /**
     * {@inheritdoc}
     */
    protected $info = "Generator funkcija";
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
    public function init()
    {
        throw new NotImplementedException("Generator funkcija nije implementiran.");
    }
}
