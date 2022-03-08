<?php

namespace neptune\spells\utils\message;

use neptune\spells\Main;

class Message {

    /**
     * @param string $identifier
     *
     * @param array $args
     *
     * @return string
     */
    public static function get(string $identifier, array $args) : string {
        $message = Dictionary::MESSAGES[$identifier];
        foreach ($args as $arg) $message = preg_replace("/[%]/", $arg, $message, 1);
        return Main::$prefix . $message;
    }
}