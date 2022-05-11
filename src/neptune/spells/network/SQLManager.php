<?php

namespace neptune\spells\network;

use \mysqli;

class SQLManager {

    public const DATABASE_SPELLS = "spells";
    public const STATEMENT_DATA_FIND = 1;

    public const REQUEST_WRITE = 0;
    public const REQUEST_EXIST = 1;
    public const REQUEST_GET = 2;

    /**
     * @param string|null $db
     *
     * @return mysqli
     */
    public static function connectSQL(string $db = null) : mysqli {
        return new mysqli("", "", "", $db);
    }

    /**
     * @param string $statement
     *
     * @param string|null $db
     */
    public static function writeData(string $statement, string $db = null) : void {
        self::connectSQL($db)->query($statement);
    }

    /**
     * @param string $statement
     *
     * @param string|null $db
     *
     * @return bool
     */
    public static function dataExist(string $statement, string $db = null) : bool {
        $sql = self::connectSQL($db)->query($statement);
        if (is_bool($sql)) return $sql;
        else return $sql->num_rows >= self::STATEMENT_DATA_FIND;
    }

    /**
     * @param string $statement
     *
     * @param string|null $db
     *
     * @return array|bool
     */
    public static function getData(string $statement, string $db = null) : array|bool {
        $db = self::connectSQL($db);
        $sql = $db->query($statement);
        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param string $db
     */
    public static function createData(string $db) : void {
        self::connectSQL()->query("CREATE DATABASE IF NOT EXISTS {$db}");
        self::connectSQL($db)->query("USE {$db}");
        self::connectSQL($db)->query("CREATE TABLE IF NOT EXISTS sessions(username VARCHAR(250), mana INT, spell VARCHAR(250))");
    }
}
