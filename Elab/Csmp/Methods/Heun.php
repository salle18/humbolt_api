<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Heun metoda Runge Kutta drugog reda.
 */
class Heun extends RungeKutta
{
    protected $description = "Heun";
    protected $className = "Heun";

    public function getTable()
    {
        return [
            [0, 0, 0],
            [1, 1, 0],
            [1, 1 / 2, 1 / 2]
        ];
    }
}
