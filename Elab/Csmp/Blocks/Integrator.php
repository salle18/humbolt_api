<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Rezultat integratora je uvek poznat za trenutno računanje, prvi put rezultat je iz početnog uslova,
 * svako sledeće izračunavanje se vrši za narednu vrednost integratora.
 * Intermediate vrednost predstavlja prelazni rezulata integratora prilikom računanja sledećeg rezultata integratora.
 */
class Integrator extends Block
{
    protected $sign = "I";
    protected $description = "Integrator";
    protected $className = "Integrator";
    protected $intermediate = 0;
    protected $info = "Integrator";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 3;

    public function init()
    {
        $this->result = $this->params[0];
    }

    public function getIntermediate()
    {
        return $this->intermediate;
    }

    public function setIntermediate($intermediate)
    {
        $this->intermediate = $intermediate;
    }

    public function calculateResult()
    {
        $this->intermediate = $this->inputs[0]->result + $this->params[1] * $this->inputs[1]->result + $this->params[2] * $this->inputs[2]->result;
    }
}
