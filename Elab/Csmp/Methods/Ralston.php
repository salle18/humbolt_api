<?php

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Class Ralston
 * Ralston metoda Runge Kutta drugog reda.
 *
 * @package Elab\Csmp\Methods
 */
class Ralston extends RungeKutta
{
    /**
     * @var string Opis metode integracije.
     */
    protected $description = "Ralston";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "Ralston";

    /**
     * Vraća Butcherovu tabelu za metodu.
     *
     * @return float[][]
     */
    public function getTable()
    {
        return [
            [0, 0, 0],
            [2 / 3, 2 / 3, 0],
            [1, 1 / 4, 3 / 4]
        ];
    }
}
