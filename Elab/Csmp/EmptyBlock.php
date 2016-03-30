<?php

namespace Elab\Csmp;

/**
 * Class EmptyBlock
 * Klasa za prazan blok bez parametara i ulaza.
 * Koristi se kao prazan ulaz na bloku.
 *
 * @package Elab\Csmp
 */
class EmptyBlock extends Block
{
    /**
     * @var boolean Da li je blok sortiran u nizu sortiranih elemenata u simulaciji.
     */
    protected $sorted = true;
}
