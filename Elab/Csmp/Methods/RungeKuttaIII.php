<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Klasična Runge Kutta metoda trećeg reda.
 */
class RungeKuttaIII extends RungeKutta
{

    protected $description = "Runge Kutta III";
    protected $className = "RungeKuttaIII";

    public function getTable()
    {
        return [
            [0, 0, 0, 0],
            [1 / 2, 1 / 2, 0, 0],
            [1, -1, 2, 0],
            [1, 1 / 6, 2 / 6, 1 / 6]
        ];
    }
}
