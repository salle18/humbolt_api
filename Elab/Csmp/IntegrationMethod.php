<?php
/**
 * Class IntegrationMethod
 */

namespace Elab\Csmp;

/**
 * Klasa metode integracije. Sve metoda integracije moraju biti izvedene iz ove klase.
 *
 * @package Elab\Csmp
 */
abstract class IntegrationMethod implements \JsonSerializable
{
    /**
     * @var Simulation Simulacija koja se izvršava.
     */
    protected $simulation = null;
    /**
     * @var string Opis metode integracije.
     */
    protected $description = "";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "IntegrationMethod";

    /**
     * @param Simulation $simulation
     */
    public function __construct(Simulation $simulation = null)
    {
        $this->simulation = $simulation;
    }

    /**
     * Pokretanje metode integracije.
     */
    public function run()
    {
        return;
    }

    /**
     * Vraća naziv i opis klase metode integracije.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "className" => $this->className,
            "description" => $this->description
        ];
    }

}
