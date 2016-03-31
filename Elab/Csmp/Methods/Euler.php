<?php
/**
 * Class Euler
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Euler metoda Runge Kutta prvog reda.
 *
 * @package Elab\Csmp\Methods
 */
class Euler extends RungeKutta
{
    /**
     * @var string Opis metode integracije.
     */
    protected $description = "Euler";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "Euler";

    /**
     * Vraća Butcherovu tabelu za metodu.
     *
     * @return float[][]
     */
    public function getTable()
    {
        return [
            [0, 0, 0],
            [1, 1, 0],
            [1, 1 / 2, 1 / 2]
        ];
    }
}
