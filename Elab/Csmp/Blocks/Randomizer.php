<?php
/**
 * Class Randomizer
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Generator slučajnih brojeva na intervalu [0, 1).
 *
 * @package Elab\Csmp\Blocks
 */
class Randomizer extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "J";
    /**
     * {@inheritdoc}
     */
    protected $description = "Random generator";
    /**
     * {@inheritdoc}
     */
    protected $className = "Randomizer";
    /**
     * {@inheritdoc}
     */
    protected $info = "Generator slučajnih brojeva, O između [0,1)";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 0;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 0;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        $this->result = mt_rand() / mt_getrandmax();
    }
}
