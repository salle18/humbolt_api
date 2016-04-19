<?php
/**
 * Class RungeKuttaIII
 */

namespace Elab\Csmp\Methods;

use Elab\Csmp\RungeKutta;

/**
 * Klasična Runge Kutta metoda trećeg reda.
 *
 * @package Elab\Csmp\Methods
 */
class RungeKuttaIII extends RungeKutta
{
    /**
     * {@inheritdoc}
     */
    protected $description = "Runge Kutta III";
    /**
     * {@inheritdoc}
     */
    protected $className = "RungeKuttaIII";

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return [
            [0, 0, 0, 0],
            [1 / 2, 1 / 2, 0, 0],
            [1, -1, 2, 0],
            [1, 1 / 6, 2 / 6, 1 / 6]
        ];
    }
}
