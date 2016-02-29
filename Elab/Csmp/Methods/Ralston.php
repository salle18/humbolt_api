<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Ralston metoda Runge Kutta drugog reda.
 */
class Ralston extends RungeKutta
{

    protected $description = "Ralston";
    protected $className = "Ralston";

    public function getTable()
    {
        return [
            [0, 0, 0],
            [2 / 3, 2 / 3, 0],
            [1, 1 / 4, 3 / 4]
        ];
    }
}
