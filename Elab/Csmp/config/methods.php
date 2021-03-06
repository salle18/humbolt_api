<?php
/**
 * Niz dostupnih metoda integracije za simuliranje.
 */

use Elab\Csmp\Methods\Euler;
use Elab\Csmp\Methods\Heun;
use Elab\Csmp\Methods\MiddlePoint;
use Elab\Csmp\Methods\Ralston;
use Elab\Csmp\Methods\RungeKuttaIII;
use Elab\Csmp\Methods\RungeKuttaIV;
use Elab\Csmp\Methods\RungeKuttaIV38;

return [
    Euler::class,
    MiddlePoint::class,
    Heun::class,
    Ralston::class,
    RungeKuttaIII::class,
    RungeKuttaIV::class,
    RungeKuttaIV38::class,
];
