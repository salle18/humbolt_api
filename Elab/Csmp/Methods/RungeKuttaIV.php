<?php
/**
 * Class RungeKuttaIV
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Klasična Runge Kutta metoda četvrtog reda.
 *
 * @package Elab\Csmp\Methods
 */
class RungeKuttaIV extends RungeKutta
{
    /**
     * {@inheritdoc}
     */
    protected $description = "Runge Kutta IV";
    /**
     * {@inheritdoc}
     */
    protected $className = "RungeKuttaIV";

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return [
            [0, 0, 0, 0, 0],
            [1 / 2, 1 / 2, 0, 0, 0],
            [1 / 2, 0, 1 / 2, 0, 0],
            [1, 0, 0, 1, 0],
            [1, 1 / 6, 2 / 6, 2 / 6, 1 / 6]
        ];
    }
}
