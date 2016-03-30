<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Class Limiter
 * Ograničavač vraća ulaz ukoliko je ulaz između donjeg i gornjeg parametra, a donji i gornji parametar inače.
 *
 * @package Elab\Csmp\Blocks
 */
class Limiter extends Block
{
    protected $sign = "L";
    protected $description = "Ograničavač";
    protected $className = "Limiter";
    protected $info = "Ograničavač, O=P1 za O<P1, O=P2 za O>P2, inače O=E1";
    protected $numberOfParams = 2;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result < $this->params[0]) {
            $this->result = $this->params[0];
        } else if ($this->inputs[0]->result > $this->params[1]) {
            $this->result = $this->params[1];
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
