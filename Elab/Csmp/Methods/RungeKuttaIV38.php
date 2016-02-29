<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Modifikacija klasične Runge Kutta metoda 3/8.
 */
class RungeKuttaIV38 extends RungeKutta
{

    protected $description = "Runge Kutta IV 3/8";
    protected $className = "RungeKuttaIV38";

    public function getTable()
    {
        return [
            [0, 0, 0, 0, 0],
            [1 / 3, 1 / 3, 0, 0, 0],
            [2 / 3, -1 / 3, 1, 0, 0],
            [1, 1, -1, 1, 0],
            [1, 1 / 8, 3 / 8, 3 / 8, 1 / 8]
        ];
    }
}
