<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Time
 * Vraća tekuće vreme simulacije.
 *
 * @package Elab\Csmp\Blocks
 */
class Time extends Block
{
    protected $sign = "T";
    protected $description = "Vreme";
    protected $className = "Time";
    protected $info = "Tekuće vreme izvršavanja simulacije";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 0;

    public function calculateResult()
    {
        $this->result = $this->simulation->getTimer();
    }
}
