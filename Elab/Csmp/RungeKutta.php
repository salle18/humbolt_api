<?php

namespace Elab\Csmp;

use Elab\Csmp\Blocks\Integrator;

/**
 * Generička klasa za sve Runge Kutta integracione metode. Izračunavanje se vrši na osnovu Butcherovih tabela.
 */
abstract class RungeKutta extends IntegrationMethod
{

    /**
     * @var string Opis metode integracije.
     */
    protected $description = "";
    /**
     * @var string Naziv klase metode integracije.
     */
    protected $className = "RungeKutta";
    /**
     * @var float[][] Butcherova metoda koja definiše metodu integracije.
     */
    protected $table = [];
    /**
     * @var Integrator[] Niz integratora u simulaciji.
     */
    private $integrators = [];

    /**
     * Vraća Butcherovu tabelu za metodu.
     *
     * @return float[][]
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Pokretanje metode integracije.
     */
    public function run()
    {
        /**
         * Inicijalizuje integratore, uzima trajanje i interval integracije simulacije.
         */
        $this->table = $this->getTable();
        $this->init();
        $duration = $this->simulation->getDuration();
        $interval = $this->simulation->getIntegrationInterval();
        $timer = 0;
        /**
         * Beleži rezultate simulacije u nultom trenutku.
         */
        $this->simulation->setResults();
        $this->simulation->saveResults();

        while ($timer < $duration) {
            $stepInterval = 0;

            /**
             * Za svaki integrator pamti početnu vrednost.
             */
            for ($i = 0;
                 $i < count($this->integrators);
                 $i++) {
                $integrator = &$this->integrators[$i];
                $integrator["previous"] = $integrator["block"]->result;
            }

            /**
             * Za svaki red u Butcherovoj tabeli vrši se računanje.
             * Prvi red se preskače.
             */
            for ($step = 1; $step < count($this->table); $step++) {
                $this->simulation->step = $step;
                for ($i = 0; $i < count($this->integrators); $i++) {
                    $integrator = &$this->integrators[$i];
                    /**
                     * Za svaki korak se računa novi koeficijent.
                     */
                    $integrator["k"][$step] = $interval * $integrator["block"]->getIntermediate();
                    $result = $integrator["previous"];
                    /**
                     * Novi rezultat se dobija kao suma proizvoda iz tekućeg reda Butcherove tabele i koeficijenata k.
                     */
                    for ($j = 1; $j < $step + 1; $j++) {
                        $result += $this->table[$step][$j] * $integrator["k"][$j];
                    }
                    $integrator["block"]->result = $result;
                }
                /**
                 * Povećava se vreme izvršavanja simulacije na osnovu prve kolone Butcherove tabele.
                 */
                $this->simulation->incrementInterval($this->table[$step][0] - $stepInterval);
                $stepInterval = $this->table[$step][0];
                $this->simulation->setResults();
            }
            /**
             * Nakon računanja svih redova iz tabele pamte se nove rezultati i uzima novo tekuće vreme izvršavanja.
             */
            $this->simulation->saveResults();
            $timer = $this->simulation->getTimer();
        }
    }

    /**
     * Puni integratore iz simulacije i postavlja koeficijente i početnu vrednost na 0.
     */
    public function init()
    {
        $integrators = $this->simulation->integrators;
        for ($i = 0; $i < count($integrators); $i++) {
            $this->integrators[] = ["block" => $integrators[$i], "k" => [0], "previous" => 0];
        }
    }
}
