<?php
/**
 * Class Amplify
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Pojačanje ulaza zadatim parametrom.
 *
 * @package Elab\Csmp\Blocks
 */
class Amplify extends Block
{
    protected $sign = "G";
    protected $description = "Pojačanje";
    protected $className = "Amplify";
    protected $info = "Pojačanje, O=P1*E1";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        $this->result = $this->params[0] * $this->inputs[0]->result;
    }
}
