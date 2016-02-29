<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\NotImplementedException;

class Wye extends Block
{
    protected $sign = "W";
    protected $description = "Wye";
    protected $className = "Wye";
    protected $info = "Implicitni element";
    protected $numberOfParams = 2;
    protected $maxNumberOfInputs = 2;

    public function calculateResult()
    {
        throw new NotImplementedException("Wye blok nije implementiran.");
    }
}
