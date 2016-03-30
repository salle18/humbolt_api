<?php

namespace Elab\Csmp;

use Elab\Csmp\Exceptions\BlockNotFoundException;
use Elab\Csmp\Exceptions\MethodNotFoundException;

/**
 * Class Config
 * Klasa koja se koristi za učitavanje dostupnih blokova i metoda integracije kao i za instanciranje blokova i metoda iz naziva klase.
 *
 * @package Elab\Csmp
 */
class Config
{

    /**
     * @var string[] Niz dostupnih blokova.
     */
    private $block_classes;
    /**
     * @var string[] Niz dostupnih metoda integracije.
     */
    private $method_classes;

    public function __construct()
    {
        $this->block_classes = require "config/blocks.php";
        $this->method_classes = require "config/methods.php";
    }

    /**
     * Vraća niz dostupnih methoda integracije.
     *
     * @return IntegrationMethod[]
     */
    public function methods()
    {
        return array_map(function ($method_class) {
            return new $method_class();
        }, $this->method_classes);
    }

    /**
     * Vraća niz dostupnih blokova.
     *
     * @return Block[]
     */
    public function blocks()
    {
        return array_map(function ($block_class) {
            return new $block_class();
        }, $this->block_classes);
    }

    /**
     * Kreira instancu date metode po nazivu klase.
     *
     * @param string $method
     * @param Simulation $simulation
     * @return IntegrationMethod
     * @throws MethodNotFoundException
     */
    public function getMethod($method, $simulation = null)
    {
        $method = "Elab\\Csmp\\Methods\\" . $method;
        $key = array_search($method, $this->method_classes);
        if ($key !== false) {
            return new $this->method_classes[$key]($simulation);
        }
        throw new MethodNotFoundException("Nije pronađena metoda integracije.");
    }

    /**
     * Kreira instancu datog bloka po nazivu zadate klase.
     *
     * @param string $block
     * @return Block
     * @throws BlockNotFoundException
     */
    public function getBlock($block)
    {
        $block = "Elab\\Csmp\\Blocks\\" . $block;
        $key = array_search($block, $this->block_classes);
        if ($key !== false) {
            return new $this->block_classes[$key]();
        }
        throw new BlockNotFoundException("Nije pronađena implementacija datog bloka.");
    }

}