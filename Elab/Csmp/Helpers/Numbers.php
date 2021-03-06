<?php
/**
 * Class Numbers
 */

namespace Elab\Csmp\helpers;

/**
 * Klasa za rad sa point float brojevima.
 *
 * @package Elab\Csmp\helpers
 */
class Numbers
{
    /**
     * @var float Epsilon dozvoljena greška.
     */
    const EPSILON = 0.00001;

    /**
     * Da li su brojevi jednaki za dozvoljenu grešku.
     *
     * @param float $a
     * @param float $b
     * @return boolean
     */
    public static function equal($a, $b)
    {
        return abs($a - $b) < self::EPSILON;
    }

    /**
     * Da li su brojevi celobrojno deljivi za zadatu grešku.
     *
     * @param float $a
     * @param float $b
     * @return boolean
     */
    public static function divideable($a, $b)
    {
        return self::equal($a, $b * floor($a / $b));
    }
}
