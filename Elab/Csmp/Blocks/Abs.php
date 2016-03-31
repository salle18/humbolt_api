<?php
/**
 * Class Abs
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Apsolutna vrednost ulaza.
 *
 * @package Elab\Csmp\Blocks
 */
class Abs extends Block
{
    protected $sign = "M";
    protected $description = "Apsolutna vrednost";
    protected $className = "Abs";
    protected $info = "Apsolutna vrednost O=|E1|";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = abs($this->inputs[0]->result);
    }
}
