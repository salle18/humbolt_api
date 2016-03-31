<?php
/**
 * Class BlockFactory
 */

namespace Elab\Csmp\Factories;

use Elab\Csmp\Block;
use Elab\Csmp\Exceptions\BlockNotFoundException;

/**
 * Klasa za instanciranje blokova.
 *
 * @package Elab\Csmp
 */
class BlockFactory
{

    const BLOCK_NAMESPACE = "Elab\\Csmp\\Blocks\\";

    /**
     * Kreira instancu datog bloka po nazivu zadate klase.
     *
     * @param string $block
     * @return Block
     * @throws BlockNotFoundException
     */
    public function create($block)
    {
        $qualifiedClassName = self::BLOCK_NAMESPACE . $block;
        if (class_exists($qualifiedClassName)) {
            return new $qualifiedClassName();
        }
        throw new BlockNotFoundException("Nije pronađena implementacija datog bloka.");
    }

}