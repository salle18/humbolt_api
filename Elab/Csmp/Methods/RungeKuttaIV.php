<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Klasična Runge Kutta metoda četvrtog reda.
 */
class RungeKuttaIV extends RungeKutta
{

    protected $description = "Runge Kutta IV";
    protected $className = "RungeKuttaIV";

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
