<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Class FunctionGenerator
 * Generator funkcija nije implementiran.
 *
 * @package Elab\Csmp\Blocks
 */
class FunctionGenerator extends Block
{
    protected $sign = "F";
    protected $description = "Generator funkcija";
    protected $className = "FunctionGenerator";
    protected $info = "Generator funkcija";
    protected $numberOfParams = 2;
    protected $maxNumberOfInputs = 1;

    public function init()
    {
        throw new NotImplementedException("Generator funkcija nije implementiran.");
    }
}
