<?php

namespace neptune\spells\network;

class Serializer {

    /**
     * @param array $data
     *
     * @return string
     */
    public static function jsonSerialize(array $data) : string { return json_encode($data); }

    /**
     * @param string $string
     *
     * @return array
     */
    public static function jsonUnserialize(string $string) : array { return json_decode($string); }
}