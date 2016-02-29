<?php

namespace Elab\Csmp;

use Elab\Csmp\blocks\Integrator;
use Elab\Csmp\blocks\Constant;
use Elab\Csmp\exceptions\SimulationException;

class Simulation
{
    /**
     * Niz integratora.
     */
    public $integrators = [];
    /**
     * Niz konstanti.
     */
    public $constants = [];
    /**
     * Da li treba optimizovati asinhrone pozive.
     */
    public $optimizeAsync = true;
    /**
     * Niz elemenata u simulaciji.
     */
    private $blocks = [];
    /**
     * Trenutno vreme izvršavanja simulacije.
     */
    private $timer = 0;
    /**
     * Metoda simulacije.
     */
    private $method = "";
    /**
     * Trajanje simulacije.
     */
    private $duration = 0;
    /**
     * Interval integracije.
     */
    private $integrationInterval = 0;
    /**
     * Niz sortiranih elemenata simulacije.
     */
    private $sorted = [];
    /**
     * Svi rezultati simulacije.
     */
    private $results = [];

    /**
     * Dodaje blok simulaciji.
     * Ako je integrator dodaje ga i u niz integratora.
     *
     * @param block Block koji se dodaje.
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
        $this->blocks = $block;
    }

    /**
     * Pokretanje simulacije.
     *
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
         * Pravimo instancu metode integracije i prosleđujemo trenutno instancu simulacije kao parametar.
         */
        $integrationMethod = new IntegrationMethodDefinitions[$this->method]($this);

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
            $this->blocks[$i]->result = 0;
            $this->blocks[$i]->sorted = false;
            $this->blocks[$i]->init();
        }
    }

    /**
     * Sortira blokove iz niza elemenata.
     * Konstante, integratori i unitDelay se odmah sortiraju jer je rezulat izračunavanja poznat iz prethodnog intervala(previousValue). Ostali blokovi moraju da imaju sve sortirane ulaze da bi se sortirali.
     */
    public function sortBlocks()
    {
        $this->sorted = [];
        $numberOfSorted = 0;
        $blocks = $this->blocks;
        for ($i = 0; $i < count($blocks); $i++) {
            if (is_a($blocks[$i], Integrator::class) || is_a($blocks[$i], Constant::class)) {
                $blocks[$i]->sorted = true;
                $this->sorted[] = $blocks[$i];
                $numberOfSorted++;
            }
        }
        for ($i = 0; $i < count($blocks); $i++) {
            if (!$blocks[$i]->sorted) {
                $this->sorted[] = $blocks[$i];
            }
        }
        $finished = false;
        while ($numberOfSorted < count($this->sorted) && !$finished) {
            $finished = true;
            for ($i = $numberOfSorted; $i < count($this->sorted); $i++) {
                $block = $this->sorted[$i];
                if ($block->hasSortedInputs()) {
                    $temp = $this->sorted[$numberOfSorted];
                    $this->sorted[$numberOfSorted] = $block;
                    $block->sorted = true;
                    $this->sorted[$i] = $temp;
                    $numberOfSorted++;
                    $finished = false;
                }
            }
        }
    }

    /**
     * Čuva trenutne rezultate.
     */
    public function saveResults()
    {
        $this->results[] = $this->getResults();
    }

    /**
     * @return Trenutni rezultati svih elemenata.
     */
    public function getResults()
    {
        $results = [$this->timer];
        for ($i = 0; $i < count($this->blocks); $i++) {
            $results[] = $this->blocks[$i]->result;
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
        return true;
    }

    /**
     * @return Svi rezultati simulacije.
     */
    public function getSimulationResults()
    {
        return $this->results;
    }

    /**
     * @return Trenutno vreme izvršavanja simulacije.
     */
    public function getTimer()
    {
        return $this->timer;
    }

    /**
     * Povećava timer za zadati deo intervala integracije.
     *
     * @param times Koliko delova intervala integracije.
     */
    public function incrementInterval($times)
    {
        $this->timer += $times * $this->integrationInterval;
    }

    /**
     * @return Trajanje simulacije.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return Interval integracije.
     */
    public function getIntegrationInterval()
    {
        return $this->integrationInterval;
    }

    /**
     * Indeks zadatog bloka u simulaciji.
     *
     * @param block Block simulacije.
     */
    public function getIndex($block)
    {
        return array_search($block, $this->blocks);
    }

    /**
     * Čuvamo nazive klasa elemenata, poziciju, parametre i ulaze kao indekse niza.
     * Nema potrebe da čuvamo izlaze jer ćemo ih rekonstruisati iz ulaza.
     *
     * @return Niz json objekata simulacije.
     */
    public function toJSON()
    {
        $result = array_map(function ($block) {
            return $block->toJSON();
        }, $this->blocks);
        return json_encode($result);
    }

    /**
     * @param JSONSimulation JSON iz kog učitavamo simulaciju.
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
        $this->optimizeAsync = $JSONSimulation["optimizeAsync"];

        $JSONBlocks = $JSONSimulation["blocks"];
        /**
         * Samo dodajemo blokove u simulaciju.
         */
        for ($i = 0; $i < count($JSONBlocks); $i++) {
            $JSONBlock = $JSONBlocks[$i];
            $className = $JSONBlock["className"];
            $block = new BlockDefinitions[$className];
            $block->params = $JSONBlock["params"];
            $block->stringParams = $JSONBlock["stringParams"];
            $block->position = $JSONBlock["position"];
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
            for ($j = 0; $j < count($JSONBlock->inputs); $j++) {
                $index = $JSONBlock->inputs[$j];
                $block->inputs[$j] = $index > -1 ? $this->blocks[$index] : new EmptyBlock();
            }
        }
    }

    /**
     * Resetuje sve nizove i brojače.
     */
    public
    function reset()
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
