<?php
/**
 * Class CircuitDelay
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Ukoliko je ulaz manji od nule vraća 0, ukoliko je veći od 0 vraća ulaz i pamti vrednost,
 * a ukoliko je nula vraća zapamćenu vrednost.
 *
 * @package Elab\Csmp\Blocks
 */
class CircuitDelay extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "Z";
    /**
     * {@inheritdoc}
     */
    protected $description = "Kolo zadrške";
    /**
     * {@inheritdoc}
     */
    protected $className = "CircuitDelay";
    /**
     * {@inheritdoc}
     */
    protected $info = "Kolo zadrške, O=0 za E2<0, O=E1 za E2>0 i memoriše se vrednost, inače je memorisana vrednost";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 0;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 2;

    /**
     * {@inheritdoc}
     */
    public function calculateResult()
    {
        if ($this->inputs[1]->result < 0) {
            $this->result = 0;
        } else if ($this->inputs[1]->result > 0) {
            $this->result = $this->inputs[0]->result;
            $this->memory = $this->result;
        } else {
            $this->result = $this->memory;
        }
    }
}
