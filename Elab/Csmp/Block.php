<?php

namespace Elab\Csmp;

/**
 * Apstraktna klasa Block. Svi csmp blokovi moraju biti izvedeni iz ove klase.
 */
abstract class Block
{

    /**
     * Niz parametara bloka.
     */
    public $params = [];
    /**
     * Niz elemenata koji su ulazi u trenutni blok.
     */
    public $inputs = [];
    /**
     * Trenutni rezultat izračunavanja bloka.
     */
    public $result = 0;
    /**
     * Da li je blok sortiran u nizu sortiranih elemenata u simulaciji.
     */
    public $sorted = false;
    /**
     * Tekstualni parametri, svi blokovi prihvataju samo numeričke parametre a IoT blok prihvata i tekstualne za unos adrese web servisa.
     */
    public $stringParams = [];
    /**
     * Top i left koordinate bloka.
     */
    public $position = ["top" => 0, "left" => 0];
    /**
     * Da li je blok trenutno aktivan.
     */
    public $active = false;
    /**
     * Da li se blok izračunava asinhrono.
     */
    public $isAsync = false;
    /**
     * Broj parametara bloka.
     */
    protected $numberOfParams = 0;
    /**
     * Broj tekstualnih parametara bloka.
     */
    protected $numberOfStringParams = 0;
    /**
     * Maksimalni broj ulaza u blok.
     */
    protected $maxNumberOfInputs = 0;
    /**
     * Pokazuje da li blok ima izlaz, samo Quit blok nema izlaz.
     */
    protected $hasOutput = true;
    /**
     * Svaki blok ima referencu na simulaciju u kojoj se nalazi. Neki blokovi zahtevaju pristup spoljnoj simulaciji kako bi se izračunali.
     */
    protected $simulation = null;
    /**
     * Memorija bloka.
     */
    protected $memory = 0;
    /**
     * Oznaka bloka.
     */
    protected $sign = "";
    /**
     * Opis bloka.
     */
    protected $description = "";
    /**
     * Info, prošireni opis bloka.
     */
    protected $info = "";
    /**
     * Naziv klase. Pošto će se kod minifikovati naziv klase mora da bude string.
     */
    protected $className = "Block";
    /**
     * Opisi numeričkih parametara.
     */
    protected $paramDescription = ["Param 1", "Param 2", "Param 3"];

    /**
     * Opisi tekstualnih parametara.
     */
    protected $stringParamDescription = ["Text 1", "Text 2", "Text 3"];


    /**
     * Inicijalizuje parametre i ulaze.
     */
    public function __construct()
    {
        /**
         * Svi parametri se na početku postavljaju na 0.
         */
        if ($this->numberOfParams > 0) {
            $this->params = array_fill(0, $this->numberOfParams, 0);
        }

        /**
         * Svi tekstualni parametri se na početku postavljaju na prazan string.
         */
        if ($this->numberOfStringParams > 0) {
            $this->stringParams = array_fill(0, $this->numberOfStringParams, "");
        }

        /**
         * Svi ulazni blokovi su na početku prazni blokovi sa rezulatom 0.
         */
        for ($i = 0; $i < $this->maxNumberOfInputs; $i++) {
            $this->inputs[$i] = new EmptyBlock();
        }
    }

    /**
     * Svaki blok može da se inicijalizuje. Ova metoda se poziva prilikom pokretanja simulacije.
     */
    public function init()
    {
        return;
    }

    /**
     * Izračunavanje rezulata bloka.
     */
    public function calculateResult()
    {
        return;
    }

    /**
     * @return Simulacija u kojoj se blok nalazi.
     */
    public function getSimulation()
    {
        return $this->simulation;
    }

    /**
     * Postavlja referencu simulacije.
     * @param simulation Simulacija u kojoj se blok nalazi.
     */
    public function setSimulation(Simulation $simulation)
    {
        $this->simulation = $simulation;
    }

    /**
     * @return Redni broj bloka u simulaciji.
     */
    public function getIndex()
    {
        return $this->simulation->getIndex($this);
    }

    /**
     * @return Da li su svi ulazni blokovi prazni ili sortirani u nizu sortiranih elemenata u simulaciji.
     */
    public function hasSortedInputs()
    {
        $sortedInputs = true;
        for ($i = 0; $i < count($this->inputs); $i++) {
            if (!$this->inputs[$i]->sorted) {
                $sortedInputs = false;
            }
        }
        return $sortedInputs;
    }

    /**
     * Čuvamo naziv klase bloka, poziciju, parametre i ulaze kao indekse niza.
     * Nema potrebe da čuvamo izlaze jer ćemo ih rekonstruisati iz ulaza.
     *
     * @return JSON objekat bloka.
     */
    public function toJSON()
    {
        return [
            "className" => $this->className,
            "position" => $this->position,
            "params" => $this->params,
            "stringParams" => $this->stringParams,
            "inputs" => array_map(function ($block) {
                return $block->getIndex();
            }, $this->inputs)
        ];
    }

    /**
     * Čuvamo sve meta podatke o bloku: klasu, broj parametara, maksimalni broj ulaza, da li blok ima izlaz, oznaku i opis bloka.
     *
     * @return JSON meta objekat bloka.
     */
    public function getMetaJSON()
    {
        return [
            "className" => $this->className,
            "numberOfParams" => $this->numberOfParams,
            "numberOfStringParams" => $this->numberOfStringParams,
            "maxNumberOfInputs" => $this->maxNumberOfInputs,
            "hasOutput" => $this->hasOutput,
            "sign" => $this->sign,
            "description" => $this->description,
            "info" => $this->info,
            "paramDescription" => $this->paramDescription,
            "stringParamDescription" => $this->stringParamDescription,
            "isAsync" => $this->isAsync
        ];
    }

}
