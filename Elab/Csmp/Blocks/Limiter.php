<?php
/**
 * Class Limiter
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Ograničavač vraća ulaz ukoliko je ulaz između donjeg i gornjeg parametra, a donji i gornji parametar inače.
 *
 * @package Elab\Csmp\Blocks
 */
class Limiter extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sign = "L";
    /**
     * {@inheritdoc}
     */
    protected $description = "Ograničavač";
    /**
     * {@inheritdoc}
     */
    protected $className = "Limiter";
    /**
     * {@inheritdoc}
     */
    protected $info = "Ograničavač, O=P1 za O<P1, O=P2 za O>P2, inače O=E1";
    /**
     * {@inheritdoc}
     */
    protected $numberOfParams = 2;
    /**
     * {@inheritdoc}
     */
    protected $maxNumberOfInputs = 1;

    /**
     * {@inheritdoc}
     */
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
