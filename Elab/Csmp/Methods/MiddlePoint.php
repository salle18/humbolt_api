<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Srednja tačka Runge Kutta metoda drugog reda.
 */
class MiddlePoint extends RungeKutta
{

    protected $description = "Metoda srednje tačke";
    protected $className = "MiddlePoint";

    public function getTable()
    {
        return [
            [0, 0, 0],
            [1 / 2, 1 / 2, 0],
            [1, 0, 1]
        ];
    }
}
