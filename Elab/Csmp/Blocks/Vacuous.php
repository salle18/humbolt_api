<?php
/**
 * Class Vacuous
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Vacuous nije implementiran.
 *
 * @package Elab\Csmp\Blocks
 */
class Vacuous extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "V";
    /**
     * {@inheritdoc}
     */
    protected $description = "Vacuous";
    /**
     * {@inheritdoc}
     */
    protected $className = "Vacuous";
    /**
     * {@inheritdoc}
     */
    protected $info = "Pomoćni element za wye";
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
        throw new NotImplementedException("Vacuous nije implementirano.");
    }
}
