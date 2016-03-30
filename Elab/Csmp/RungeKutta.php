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
        $duration = $this->simulation->getDuration();
        $interval = $this->simulation->getIntegrationInterval();
        $timer = 0;
        /**
         * Beleži rezultate simulacije u nultom trenutku.
         */
        $this->simulation->setResults();
        $this->simulation->saveResults();

        /**
         * @var Integrator[] Niz stanja integratora u simulaciji.
         */
        $integrators = $this->simulation->getIntegrators();

        while ($timer < $duration) {
            $stepInterval = 0;

            /**
             * Za svaki integrator pamti početnu vrednost.
             */
            for ($i = 0; $i < count($integrators); $i++) {
                $integrators[$i]->setPrevious();
            }

            /**
             * Za svaki red u Butcherovoj tabeli vrši se računanje.
             * Prvi red se preskače.
             */
            for ($step = 1; $step < count($this->table); $step++) {
                $this->simulation->setStep($step);
                for ($i = 0; $i < count($integrators); $i++) {

                    $integrator = $integrators[$i];

                    /**
                     * Za svaki korak se računa novi inkrement.
                     */
                    $integrator->setIncrement($step, $interval * $integrator->getIntermediate());
                    $result = $integrator->getPrevious();
                    /**
                     * Novi rezultat se dobija kao suma proizvoda iz tekućeg reda Butcherove tabele i inkrementa.
                     */
                    for ($j = 1; $j < $step + 1; $j++) {
                        $result += $this->table[$step][$j] * $integrator->getIncrement($j);
                    }
                    $integrator->setResult($result);
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
}