<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\CalculationException;
use Elab\Csmp\helpers\Numbers;

/**
 * Class ImpulseGenerator
 * Generator impulsa. Generiše povorku impulsa od trenutka kada je ulaz veći od nule.
 *
 * @package Elab\Csmp\Blocks
 */
class ImpulseGenerator extends Block
{
    protected $sign = "Y";
    protected $description = "Generator impulsa";
    protected $className = "ImpulseGenerator";
    protected $info = "Generator impulsa";
    protected $numberOfParams = 1;
    protected $maxNumberOfInputs = 1;
    private $generate = false;
    private $interval = 0;
    private $startInterval = 0;


    public function init()
    {
        $this->result = 0;
        $this->interval = $this->params[0];
        $this->startInterval = 0;
        if (!Numbers::divideable($this->interval, $this->simulation->getIntegrationInterval())) {
            throw new CalculationException("Interval generatora impulsa treba da bude umnožak intervala integracije.");
        }
    }

    public function calculateResult()
    {
        if ($this->generate) {
            if (Numbers::divideable($this->simulation->getTimer() - $this->startInterval, $this->interval)) {
                $this->result = 1;
            } else {
                $this->result = 0;
            }
        } else if ($this->inputs[0]->result > 0) {
            $this->generate = true;
            $this->startInterval = $this->simulation->getTimer();
            $this->calculateResult();
        }
    }
}
