<?php

namespace App\Utils;

use DateTimeImmutable;

class DataUtil
{

    /**
     * Returns a new instance of DateTimeImmutable.
     *
     * @return DateTimeImmutable
     */

    public static function getDateTimeImmutable()
    {
        return new DateTimeImmutable();
    }

    /**
     * Return the current time in the format H:i:s.
     *
     * @return string
     */
    public static function getDateTimeImmutableNow() : string
    {
        return date_format(self::getDateTimeImmutable(), 'H:i:s');
    }

    
    /**
     * Return the current date in the format Y-m-d.
     *
     * @return string
     */
    public static function getDateNowYmd() : string
    {
        return date_format(self::getDateTimeImmutable(), 'Y-m-d');
    }
}
