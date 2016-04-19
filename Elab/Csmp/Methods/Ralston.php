<?php
/**
 * Class Ralston
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Ralston metoda Runge Kutta drugog reda.
 *
 * @package Elab\Csmp\Methods
 */
class Ralston extends RungeKutta
{
    /**
     * {@inheritdoc}
     */
    protected $description = "Ralston";
    /**
     * {@inheritdoc}
     */
    protected $className = "Ralston";

    /**
     * {@inheritdoc}
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
