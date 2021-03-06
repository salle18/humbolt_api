<?php
/**
 * Class IntegrationMethodFactory
 */

namespace Elab\Csmp\Factories;

use Elab\Csmp\Exceptions\BlockNotFoundException;
use Elab\Csmp\Simulation;

/**
 * Klasa za instanciranje integracionih metoda.
 *
 * @package Elab\Csmp\Factories
 */
class IntegrationMethodFactory
{
    const INTEGRATION_METHOD_NAMESPACE = "Elab\\Csmp\\Methods\\";

    /**
     * Kreira instancu date metode po nazivu klase.
     *
     * @param string $method
     * @param Simulation $simulation
     * @return mixed
     * @throws BlockNotFoundException
     */
    public function create($method, Simulation $simulation)
    {
        $qualifiedClassName = self::INTEGRATION_METHOD_NAMESPACE . $method;
        if (class_exists($qualifiedClassName)) {
            return new $qualifiedClassName($simulation);
        }
        throw new BlockNotFoundException("Nije pronađena implementacija datog bloka.");
    }

}