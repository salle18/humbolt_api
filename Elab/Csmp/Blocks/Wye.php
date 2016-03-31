<?php
/**
 * Class Wye
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Wye nije implementiran.
 *
 * @package Elab\Csmp\Blocks
 */
class Wye extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "W";
    /**
     * {@inheritdoc}
     */
    protected $description = "Wye";
    /**
     * {@inheritdoc}
     */
    protected $className = "Wye";
    /**
     * {@inheritdoc}
     */
    protected $info = "Implicitni element";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 2;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 2;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        throw new NotImplementedException("Wye blok nije implementiran.");
    }
}
