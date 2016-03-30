<?php

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\SimulationException;
use Elab\Csmp\IoTService;

/**
 * Internet of things računa rezultat na zadatom web servisu i vraća odgovor nakon toga.
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

    public function init()
    {
        if (!$this->stringParams[0]) {
            throw new SimulationException("IoT url ne može biti prazan.");
        }
    }

    public function calculateResult()
    {
        if (!$this->simulation->shouldOptimizeAsync() || $this->simulation->getStep() === 1) {
            $this->result = $this->service->load();
        }
    }
}
