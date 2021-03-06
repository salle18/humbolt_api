<?php
/**
 * Class Integrator
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Rezultat integratora je uvek poznat za trenutno računanje, prvi put rezultat je iz početnog uslova, svako sledeće izračunavanje se vrši za narednu vrednost integratora.
 * Intermediate vrednost predstavlja prelazni rezulata integratora prilikom računanja sledećeg rezultata integratora.
 *
 * @package Elab\Csmp\Blocks
 */
class Integrator extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "I";
    /**
     * {@inheritdoc}
     */
    protected $description = "Integrator";
    /**
     * {@inheritdoc}
     */
    protected $className = "Integrator";
    /**
     * @var float Među vrednost izračunavanja vrednosti integratora.
     */
    protected $intermediate = 0;
    /**
     * {@inheritdoc}
     */
    protected $info = "Integrator";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 3;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 3;

    /**
     * @var array Inkrementi integratora.
     */
    private $increments;

    /**
     * {@inheritdoc}
     * Inicijalizuje integrator.
     */
    public function init()
    {
        $this->result = $this->params[0];
        $this->intermediate = 0;
        $this->memory = 0;
        $this->increments = [0];
    }

    /**
     * Vraća među vrednost.
     *
     * @return float
     */
    public function getIntermediate()
    {
        return $this->intermediate;
    }

    /**
     * {@inheritdoc}
     * Postavlja među vrednost.
     */
    public function calculateResult()
    {
        $this->intermediate = $this->inputs[0]->result + $this->params[1] * $this->inputs[1]->result + $this->params[2] * $this->inputs[2]->result;
    }

    /**
     * Vraća zapamćenu vrednost rezultata.
     *
     * @return float
     */
    public function getPrevious()
    {
        return $this->memory;
    }

    /**
     * Pamti trenutnu vrednost rezulata.
     */
    public function setPrevious()
    {
        $this->memory = $this->result;
    }

    /**
     * Vraća vrednost inkrementa za zadati indeks.
     *
     * @param integer $index
     * @return float
     */
    public function getIncrement($index)
    {
        return $this->increments[$index];
    }

    /**
     * Postavlja vrednost inkrementa za zadati indeks.
     *
     * @param integer $index
     * @param float $value
     */
    public function setIncrement($index, $value)
    {
        $this->increments[$index] = $value;
    }


}
