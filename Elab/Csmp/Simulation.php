<?php

namespace Elab\Csmp;

use Elab\Csmp\blocks\Constant;
use Elab\Csmp\blocks\Integrator;
use Elab\Csmp\exceptions\SimulationException;

/**
 * Class Simulation
 * Simulacija u sebi sadrži niz blokova, pre simuliranja blokovi se moraju sortirati.
 * Simulacija se možete učitavati i izvoziti u JSON.
 *
 * @package Elab\Csmp
 */
class Simulation
{
    /**
     * @var Integrator[] Niz integratora.
     */
    private $integrators = [];
    /**
     * @var Constant[] Niz konstanti.
     */
    private $constants = [];
    /**
     * @var boolean Da li treba optimizovati asinhrone pozive.
     */
    private $optimizeAsync = true;
    /**
     * @var Block[] Niz elemenata u simulaciji.
     */
    private $blocks = [];
    /**
     * @var float Trenutno vreme izvršavanja simulacije.
     */
    private $timer = 0;
    /**
     * @var string Metoda simulacije.
     */
    private $method = "";
    /**
     * @var float Trajanje simulacije.
     */
    private $duration = 0;
    /**
     * @var float Interval integracije.
     */
    private $integrationInterval = 0;
    /**
     * @var Block[] Niz sortiranih elemenata simulacije.
     */
    private $sorted = [];
    /**
     * @var float[][] Svi rezultati simulacije.
     */
    private $results = [];
    /**
     * @var integer Red Butcherove tabele koji se trenutno izvršava, potrebno zbog optimizacije IoT elementa.
     */
    private $step = 0;

    /**
     * @var Config
     */
    private $config;

    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * Dodaje blok u simulaciju.
     * Ako je integrator ili konstanta dodaje ga i u respektivni niz.
     *
     * @param Block
     */
    public function addBlock(Block $block)
    {
        $block->setSimulation($this);
        if (is_a($block, Integrator::class)) {
            $this->integrators[] = $block;
        }
        if (is_a($block, Constant::class)) {
            $this->constants[] = $block;
        }
        $this->blocks[] = $block;
    }

    /**
     * Pokretanje simulacije.
     */
    public function run()
    {
        /**
         * Restujemo niz rezultata. Postavljamo interval i trajanje i resetujemo vreme.
         */
        $this->results = [];
        $this->timer = 0;

        /**
         * Pre pokretanja integracije vršimo sve provere.
         */
        $this->preRunCheck();
        /**
         * Pravimo instancu metode integracije i prosleđujemo instancu simulacije kao parametar.
         */
        $integrationMethod = $this->config->getMethod($this->method, $this);

        /**
         * Resetujemo rezultate elemenata i inicijalizujemo ih.
         */
        $this->initBlocks();
        /**
         * Sortiramo blokove po njihovim ulazima.
         */
        $this->sortBlocks();
        /**
         * Pokrećemo metodu integracije.
         */
        $integrationMethod->run();
    }

    /**
     * Provera parametara simulacije pre pokretanja.
     */
    public function preRunCheck()
    {
        if (!($this->duration > 0)) {
            throw new SimulationException("Dužina simulacije mora biti veća od nule.");
        }
        if (!($this->integrationInterval > 0)) {
            throw new SimulationException("Interval integracije mora biti veći od nule.");
        }
        if ($this->duration < $this->integrationInterval) {
            throw new SimulationException("Dužina simulacije mora biti veća od intervala integracije.");
        }
        if (count($this->blocks) === 0) {
            throw new SimulationException("Simulacija mora da ima najmanje jedan blok.");
        }
        /**
         * Ako nema integratora onda nema potrebe vršiti izračunvanja na međuintervalima pa je metoda Euler,
         * izračunavanje se vrši samo jednom na početku svakog intervala integracije.
         */
        if (count($this->integrators) === 0) {
            $this->method = "Euler";
        }
    }

    /**
     * Inicijalizacija elemenata. Rezultati se postavljaju na 0 a zatim se poziva init svakog bloka.
     */
    public function initBlocks()
    {
        for ($i = 0; $i < count($this->blocks); $i++) {
            $this->blocks[$i]->setResult(0);
            $this->blocks[$i]->setSorted(false);
            $this->blocks[$i]->init();
        }
    }

    /**
     * Sortira blokove iz niza elemenata.
     * Konstante i integratori se odmah sortiraju jer je rezulat izračunavanja poznat iz prethodnog intervala(previousValue).
     * Ostali blokovi moraju da imaju sve sortirane ulaze da bi se sortirali. EmptyBlock je uvek sortiran.
     */
    public function sortBlocks()
    {
        $this->sorted = [];
        $numberOfSorted = 0;
        $blocks = $this->blocks;
        /**
         * Sortiramo konstante i integratore.
         */
        for ($i = 0; $i < count($blocks); $i++) {
            if (is_a($blocks[$i], Integrator::class) || is_a($blocks[$i], Constant::class)) {
                $blocks[$i]->setSorted(true);
                $this->sorted[] = $blocks[$i];
                $numberOfSorted++;
            }
        }
        for ($i = 0; $i < count($blocks); $i++) {
            if (!$blocks[$i]->isSorted()) {
                $this->sorted[] = $blocks[$i];
            }
        }
        /**
         * Obezbeđujemo da ne dođe do beskonačne petlje ukoliko postoji ciklična petlja među blokovima.
         * U tom slučaju prvi blok u ciklusu se postavlja na sortiran i nastavlja se sortiranje.
         */
        $finished = false;
        while ($numberOfSorted < count($this->sorted) && !$finished) {
            $finished = true;
            for ($i = $numberOfSorted; $i < count($this->sorted); $i++) {
                $block = $this->sorted[$i];
                if ($block->hasSortedInputs()) {
                    $temp = $this->sorted[$numberOfSorted];
                    $this->sorted[$numberOfSorted] = $block;
                    $block->setSorted(true);
                    $this->sorted[$i] = $temp;
                    $numberOfSorted++;
                    $finished = false;
                }
            }
        }
    }

    /**
     * Dodaje trenutne rezultate u multidimenzionalni niz rezultata.
     */
    public function saveResults()
    {
        $this->results[] = $this->getResults();
    }

    /**
     * Trenutni rezultati svih blokova.
     *
     * @return float[]
     */
    public function getResults()
    {
        $results = [$this->timer];
        for ($i = 0; $i < count($this->blocks); $i++) {
            $results[] = $this->blocks[$i]->getResult();
        }
        return $results;
    }

    /**
     * Izračunava rezulatate za sve blokove.
     */
    public function setResults()
    {
        $blocks = $this->sorted;
        for ($i = count($this->integrators) + count($this->constants); $i < count($blocks); $i++) {
            $blocks[$i]->calculateResult();
        }
        /**
         * Za sve integratore ponovo pozivamo calculateResult kako bi se izračunao novi rezultat.
         */
        for ($i = 0; $i < count($this->integrators); $i++) {
            $this->integrators[$i]->calculateResult();
        }
    }

    /**
     * Vraća multidimenzionalni niz svih rezultata simulacije.
     *
     * @return float[][]
     */
    public function getSimulationResults()
    {
        return $this->results;
    }

    /**
     * Trenutno vreme izvršavanja simulacije.
     *
     * @return float
     */
    public function getTimer()
    {
        return $this->timer;
    }

    /**
     * Povećava timer za zadati deo intervala integracije.
     *
     * @param float $times
     */
    public function incrementInterval($times)
    {
        $this->timer += $times * $this->integrationInterval;
    }

    /**
     * Vraća trajanje simulacije.
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     *  Vraća interval integracije.
     *
     * @return float
     */
    public function getIntegrationInterval()
    {
        return $this->integrationInterval;
    }

    /**
     * Vraća niz integratora u simulaciji.
     *
     * @return Integrator[]
     */
    public function getIntegrators()
    {
        return $this->integrators;
    }

    /**
     * Vraća indeks zadatog bloka u simulaciji.
     *
     * @param Block $block
     * @return integer
     */
    public function getIndex(Block $block)
    {
        $key = array_search($block, $this->blocks);
        return $key === false ? -1 : $key;
    }

    /**
     * Postavlja red Butcherove tabele koji se trenutno izvršava.
     *
     * @param integer $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * Čuvamo nazive klasa elemenata, poziciju, parametre i ulaze kao indekse niza.
     * Nema potrebe da čuvamo izlaze jer ćemo ih rekonstruisati iz ulaza.
     *
     * @return string
     */
    public function toJSON()
    {
        $result = array_map(function (Block $block) {
            return $block->toJSON();
        }, $this->blocks);
        return json_encode($result);
    }

    /**
     * Učitavamo simulaciju iz niza.
     *
     * @param array $JSONSimulation
     */
    public function loadJSON($JSONSimulation)
    {
        /**
         * Pre učitavanja elemenata resetujemo simulaciju.
         */
        $this->reset();

        $this->method = $JSONSimulation["method"];
        $this->integrationInterval = $JSONSimulation["integrationInterval"];
        $this->duration = $JSONSimulation["duration"];
        $this->optimizeAsync = isset($JSONSimulation["optimizeAsync"]) ? $JSONSimulation["optimizeAsync"] : false;

        $JSONBlocks = $JSONSimulation["blocks"];
        /**
         * Samo dodajemo blokove u simulaciju.
         */
        for ($i = 0; $i < count($JSONBlocks); $i++) {
            $JSONBlock = $JSONBlocks[$i];
            $className = $JSONBlock["className"];
            $block = $this->config->getBlock($className);
            $block->setParams($JSONBlock["params"]);
            $block->setStringParams($JSONBlock["stringParams"]);
            $block->setPosition($JSONBlock["position"]);
            $this->addBlock($block);
        }

        /**
         * Ponovo prolazimo kroz sve blokove i dodajemo veze.
         */
        for ($i = 0; $i < count($JSONBlocks); $i++) {
            $JSONBlock = $JSONBlocks[$i];
            $block = $this->blocks[$i];
            /**
             * Rekonstruišemo sve ulaze na bloku.
             */
            for ($j = 0; $j < count($JSONBlock["inputs"]); $j++) {
                $index = $JSONBlock["inputs"][$j];
                $input = $index > -1 ? $this->blocks[$index] : new EmptyBlock();
                $block->setInput($j, $input);
            }
        }
    }

    /**
     * Resetuje sve nizove i brojače.
     */
    public function reset()
    {
        $this->blocks = [];
        $this->sorted = [];
        $this->results = [];
        $this->integrators = [];
        $this->constants = [];
        $this->timer = 0;
        $this->duration = 0;
        $this->integrationInterval = 0;
    }

}
