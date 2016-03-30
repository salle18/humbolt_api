<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

/**
 * Class Vacuous
 * Vacuous nije implementiran.
 *
 * @package Elab\Csmp\Blocks
 */
class Vacuous extends Block
{
    protected $sign = "V";
    protected $description = "Vacuous";
    protected $className = "Vacuous";
    protected $info = "Pomoćni element za wye";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 0;

    public function calculateResult()
    {
        throw new NotImplementedException("Vacuous nije implementirano.");
    }
}
