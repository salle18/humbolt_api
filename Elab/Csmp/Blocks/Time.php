<?php
/**
 * Class Time
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Vraća tekuće vreme simulacije.
 *
 * @package Elab\Csmp\Blocks
 */
class Time extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "T";
    /**
     * {@inheritdoc}
     */
    protected $description = "Vreme";
    /**
     * {@inheritdoc}
     */
    protected $className = "Time";
    /**
     * {@inheritdoc}
     */
    protected $info = "Tekuće vreme izvršavanja simulacije";
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
        $this->result = $this->simulation->getTimer();
    }
}
