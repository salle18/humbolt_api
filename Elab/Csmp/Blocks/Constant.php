<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Constant
 * Konstanta, uvek vraća vrednost prvog parametra.
 *
 * @package Elab\Csmp\Blocks
 */
class Constant extends Block
{
    protected $sign = "K";
    protected $description = "Konstanta";
    protected $className = "Constant";
    protected $info = "Konstanta, O=P1";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 0;

    public function init()
    {
        $this->result = $this->params[0];
    }
}
