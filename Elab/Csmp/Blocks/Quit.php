<?php
/**
 * Class Quit
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\QuitSimulationException;

/**
 * Prekida izvršavanje simulacije.
 *
 * @package Elab\Csmp\Blocks
 */
class Quit extends Block
{
    protected $sign = "Q";
    protected $description = "Quit";
    protected $className = "Quit";
    protected $hasOutput = false;
    protected $info = "Prekid izvršavanja simulacije ukoliko je E2<E1";
    protected $numberOfParams = 0;
    protected $maxNumberOfInputs = 2;

    public function calculateResult()
    {
        if ($this->inputs[1]->result < $this->inputs[0]->result) {
            throw new QuitSimulationException("Simulacija završena.");
        }
    }
}
