<?php
/**
 * Class PositiveLimiter
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Pozitivni ograničavač vraća ulaz ukoliko je manji od nule, a nulu inače.
 *
 * @package Elab\Csmp\Blocks
 */
class PositiveLimiter extends Block
{
    protected $sign = "P";
    protected $description = "Pozitivni ograničavač";
    protected $className = "PositiveLimiter";
    protected $info = "Pozitivni ograničavač, O=0 za E1>0, inače O=E1";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 1;

    public function calculateResult()
    {
        if ($this->inputs[0]->result > 0) {
            $this->result = 0;
        } else {
            $this->result = $this->inputs[0]->result;
        }
    }
}
