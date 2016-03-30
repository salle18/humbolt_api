<?php

namespace Elab\Csmp;

/**
 * Klasa za prazan blok bez parametara i ulaza.
 * Koristi se kao prazan ulaz na bloku.
 */
class EmptyBlock extends Block
{
    /**
     * @var boolean Da li je blok sortiran u nizu sortiranih elemenata u simulaciji.
     */
    protected $sorted = true;
}
