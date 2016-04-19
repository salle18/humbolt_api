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
     * {@inheritdoc}
     */
    protected $description = "Metoda srednje tačke";
    /**
     * {@inheritdoc}
     */
    protected $className = "MiddlePoint";

    /**
     * {@inheritdoc}
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
