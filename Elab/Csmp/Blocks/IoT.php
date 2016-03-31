<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\SimulationException;
use Elab\Csmp\IoTService;

/**
 * Class IoT
 * Internet of things računa rezultat na zadatom web servisu i vraća odgovor nakon toga.
 *
 * @package Elab\Csmp\Blocks
 */
class IoT extends Block
{
    public $stringParams = [""];
    public $isAsync = true;
    protected $sign = "IoT";
    protected $description = "Internet of Things";
    protected $className = "IoT";
    protected $info = "IoT, poziva zadati web servis da bi dobio rezultat";
    protected $numberOfParams = 3;
    protected $maxNumberOfInputs = 3;
    protected $numberOfStringParams = 1;
    protected $stringParamDescription = ["url"];
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new IoTService($this);
    }

    /**
     * Provera da li je zadata ispravna adresa webservisa.
     *
     * @throws SimulationException
     */
    public function init()
    {
        if (!$this->stringParams[0]) {
            throw new SimulationException("IoT url ne može biti prazan.");
        }
        if (!filter_var($this->stringParams[0], FILTER_VALIDATE_URL)) {
            throw new SimulationException("IoT url nije ispravna url adresa.");
        }
    }

    /**
     * Poziva IoTService i postavlja rezultat izračunavanja sa webservisa.
     * Ukoliko treba optimizivati asinhrone pozive poziva webservis samo ukoliko se trenutno izvršava prvi red u Butcherovoj tabeli.
     *
     * @throws \Elab\Csmp\Exceptions\IoTException
     */
    public function calculateResult()
    {
        if (!$this->simulation->shouldOptimizeAsync() || $this->simulation->getStep() === 1) {
            $this->result = $this->service->load();
        }
    }
}
