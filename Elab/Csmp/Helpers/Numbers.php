<?php

namespace Elab\Csmp\helpers;

/**
 * Klasa za rad sa point float brojevima.
 */
class Numbers
{
    /**
     * Epsilon dozvoljena greška.
     */
    const EPSILON = 0.00001;

    /**
     * @return Da li su brojevi jednaki za dozvoljenu grešku.
     */
    public static function equal($a, $b)
    {
        return abs($a - $b) < self::EPSILON;
    }

    /**
     * @return Da li su brojevi celobrojno deljivi za zadatu grešku.
     */
    public static function divideable($a, $b)
    {
		return self::equal($a, $b * floor($a / $b));
	}
}
