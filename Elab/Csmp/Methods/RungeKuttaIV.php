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
     * @var string Opis metode integracije.
     */
    protected $description = "Runge Kutta IV";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "RungeKuttaIV";

    /**
     * Vraća Butcherovu tabelu za metodu.
     *
     * @return float[][]
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
