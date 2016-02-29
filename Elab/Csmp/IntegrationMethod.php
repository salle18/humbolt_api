<?php

namespace Elab\Csmp;

/**
 * Klasa metode integracije. Sve metoda integracije moraju biti izvedene iz ove klase.
 */
abstract class IntegrationMethod
{
    protected $simulation = null;
    protected $description = "";
    protected $className = "IntegrationMethod";

    /**
     * @param simulation Tekuća simulacija.
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
     * @return Naziv klase metode integracije.
     */
    public function getMetaJSON()
    {
        return [
            "className" => $this->className,
            "description" => $this->description
        ];
    }

}
