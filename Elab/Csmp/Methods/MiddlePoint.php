<?php
/**
 * Class MiddlePoint
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Srednja tačka Runge Kutta metoda drugog reda.
 *
 * @package Elab\Csmp\Methods
 */
class MiddlePoint extends RungeKutta
{
    /**
     * @var string Opis metode integracije.
     */
    protected $description = "Metoda srednje tačke";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "MiddlePoint";

    /**
     * Vraća Butcherovu tabelu za metodu.
     *
     * @return float[][]
     */
    public function getTable()
    {
        return [
            [0, 0, 0],
            [1 / 2, 1 / 2, 0],
            [1, 0, 1]
        ];
    }
}
