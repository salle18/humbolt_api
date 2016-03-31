<?php
/**
 * Class EmptyBlock
 */

namespace Elab\Csmp\Blocks;

use Elab\Csmp\Block;

/**
 * Klasa za prazan blok bez parametara i ulaza.
 * Koristi se kao prazan ulaz na bloku.
 *
 * @package Elab\Csmp
 */
class EmptyBlock extends Block
{
    /**
     * {@inheritdoc}
     */
    protected $sorted = true;
}
