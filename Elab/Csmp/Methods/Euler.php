<?php
/**
 * Class Euler
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Euler metoda Runge Kutta prvog reda.
 *
 * @package Elab\Csmp\Methods
 */
class Euler extends RungeKutta
{
    /**
     * {@inheritdoc}
     */
    protected $description = "Euler";
    /**
     * {@inheritdoc}
     */
    protected $className = "Euler";

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return [
            [0, 0, 0],
            [1, 1, 0],
            [1, 1 / 2, 1 / 2]
        ];
    }
}
