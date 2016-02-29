<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Euler metoda Runge Kutta prvog reda.
 */
class Euler extends RungeKutta
{
    protected $description = "Euler";
    protected $className = "Euler";

    public function getTable()
    {
        return [
            [0, 0, 0],
            [1, 1, 0],
            [1, 1 / 2, 1 / 2]
        ];
    }
}
