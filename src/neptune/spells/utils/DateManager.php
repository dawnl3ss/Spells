<?php

namespace neptune\spells\utils;

class DateManager {

    /** @var string $lastDay */
    public static string $lastDay;

    /**
     * @return string
     */
    public static function getCurrentDay(){
        date_default_timezone_set("Europe/Paris");
        return date('d');
    }

    public static function setCurrentDay() : void {
        date_default_timezone_set("Europe/Paris");
        self::$lastDay = date('d');
    }

    /**
     * @return bool
     */
    public static function checkDay() : bool {
        if (self::getCurrentDay() != self::$lastDay){
            self::setCurrentDay();
            return true;
        } else return false;
    }
}