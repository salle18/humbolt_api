<?php
/**
 * Class NegativeLimiter
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Negativni ograničavač vraća ulaz ukoliko je veći od nule, a nulu inače.
 *
 * @package Elab\Csmp\Blocks
 */
class NegativeLimiter extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "N";
    /**
     * {@inheritdoc}
     */
    protected $description = "Negativni ograničavač";
    /**
     * {@inheritdoc}
     */
    protected $className = "NegativeLimiter";
    /**
     * {@inheritdoc}
     */
    protected $info = "Negativni ograničavač, O=0 za E1<0, inače O=E1";
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
        if ($this->inputs[0]->result < 0) {
            $this->result = 0;
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
