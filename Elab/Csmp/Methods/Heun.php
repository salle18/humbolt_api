<?php
/**
 * Class Heun
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Heun metoda Runge Kutta drugog reda.
 *
 * @package Elab\Csmp\Methods
 */
class Heun extends RungeKutta
{
    /**
     * {@inheritdoc}
     */
    protected $description = "Heun";
    /**
     * {@inheritdoc}
     */
    protected $className = "Heun";

    /**
     * {@inheritdoc}
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
