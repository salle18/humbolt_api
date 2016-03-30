<?php

namespace Elab\Csmp;

/**
 * Apstraktna klasa Block. Svi csmp blokovi moraju biti izvedeni iz ove klase.
 */
abstract class Block
{

    /**
     * @var float[] Niz parametara bloka.
     */
    protected $params = [];
    /**
     * @var Block[] Niz blokova koji su ulazi u trenutni blok.
     */
    protected $inputs = [];
    /**
     * @var float Trenutni rezultat izračunavanja bloka.
     */
    protected $result = 0;
    /**
     * @var boolean Da li je blok sortiran u nizu sortiranih elemenata u simulaciji.
     */
    protected $sorted = false;
    /**
     * @var string[] Tekstualni parametri, svi blokovi prihvataju samo numeričke parametre a IoT blok prihvata i tekstualne za unos adrese web servisa.
     */
    protected $stringParams = [];
    /**
     * @var array Top i left koordinate bloka.
     */
    protected $position = ["top" => 0, "left" => 0];
    /**
     * @var boolean Da li se blok izračunava asinhrono.
     */
    protected $isAsync = false;
    /**
     * @var integer Broj parametara bloka.
     */
    protected $numberOfParams = 0;
    /**
     * @var integer Broj tekstualnih parametara bloka.
     */
    protected $numberOfStringParams = 0;
    /**
     * @var integer Maksimalni broj ulaza u blok.
     */
    protected $maxNumberOfInputs = 0;
    /**
     * @var boolean Pokazuje da li blok ima izlaz, samo Quit blok nema izlaz.
     */
    protected $hasOutput = true;
    /**
     * @var Simulation Svaki blok ima referencu na simulaciju u kojoj se nalazi.
     * Neki blokovi zahtevaju pristup spoljnoj simulaciji kako bi se izračunali npr. Time blok.
     */
    protected $simulation = null;
    /**
     * @var float Memorija bloka.
     */
    protected $memory = 0;
    /**
     * @var string Oznaka bloka.
     */
    protected $sign = "";
    /**
     * @var string Opis bloka.
     */
    protected $description = "";
    /**
     * @var string Info, prošireni opis bloka.
     */
    protected $info = "";
    /**
     * @var string Naziv klase bloka.
     */
    protected $className = "Block";
    /**
     * @var string[] Opisi numeričkih parametara.
     */
    protected $paramDescription = ["Param 1", "Param 2", "Param 3"];

    /**
     * @var string[] Opisi tekstualnih parametara.
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
         * Svi ulazni blokovi su na početku EmptyBlock sa rezulatom 0.
         */
        for ($i = 0; $i < $this->maxNumberOfInputs; $i++) {
            $this->inputs[$i] = new EmptyBlock();
        }
    }

    /**
     * Svaki blok može da se inicijalizuje. Ova metoda se poziva prilikom pokretanja simulacije za svaki blok.
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
     * Vraća simulaciju u kojoj se blok nalazi.
     *
     * @return Simulation
     */
    public function getSimulation()
    {
        return $this->simulation;
    }

    /**
     * Postavlja referencu simulacije u kojoj se blok nalazi.
     *
     * @param Simulation $simulation
     */
    public function setSimulation(Simulation $simulation)
    {
        $this->simulation = $simulation;
    }

    /**
     * Vraća niz parametara bloka.
     *
     * @return float[]
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Postavlja parametre bloka.
     *
     * @param float[] $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Postavlja parametar bloka sa zadatim indeksom.
     *
     * @param integer $index
     * @param float $param
     */
    public function setParam($index, $param)
    {
        $this->params[$index] = $param;
    }

    /**
     * Postavlja ulaz bloka za zadati indeks.
     *
     * @param integer $index
     * @param Block $input
     */
    public function setInput($index, Block $input)
    {
        $this->inputs[$index] = $input;
    }

    /**
     * Vraća redni broj bloka u simulaciji.
     *
     * @return integer
     */
    public function getIndex()
    {
        return $this->simulation->getIndex($this);
    }

    /**
     * Vraća da li su svi ulazni blokovi prazni ili sortirani u nizu sortiranih elemenata u simulaciji.
     *
     * @return boolean
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
     * Čuva naziv klase bloka, poziciju, parametre i ulaze kao indekse niza.
     * Nema potrebe da čuvamo izlaze jer ćemo ih rekonstruisati iz ulaza.
     *
     * @return array
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
     * Čuva sve meta podatke o bloku: klasu, broj parametara, maksimalni broj ulaza, da li blok ima izlaz, oznaku i opis bloka.
     *
     * @return array
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
