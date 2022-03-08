<?php

namespace neptune\spells\network\session;

use neptune\spells\Main;
use neptune\spells\network\Serializer;
use neptune\spells\network\SQLManager;
use neptune\spells\spell\Spell;
use neptune\spells\task\async\SQLRequestAsync;
use pocketmine\player\Player;
use pocketmine\Server;

class SessionManager {

    /** @var Session[] $sessions */
    public static array $sessions = [];

    /**
     * @param Player $player
     *
     * @param Session $session
     */
    public static function addSession(Player $player, Session $session) : void {
        self::$sessions[strtolower($player->getName())] = $session;
    }

    /**
     * @param Player $player
     */
    public static function deleteSession(Player $player) : void {
        unset(self::$sessions[strtolower($player->getName())]);
    }

    /**
     * @param Player $player
     *
     * @return Session
     */
    public static function getSession(Player $player) : Session {
        return self::$sessions[strtolower($player->getName())];
    }

    /**
     * @param Player $player
     *
     * @return bool
     */
    public static function hasSession(Player $player) : bool {
        return array_key_exists(strtolower($player->getName()), self::$sessions);
    }

    /**
     * @param Player $player
     *
     * @return Session
     */
    public static function getSqlSession(Player $player) : Session {
        Main::getInstance()->getServer()->getAsyncPool()->submitTask($reqTask = new SQLRequestAsync(
            "SELECT * FROM `sessions` WHERE username = '" . strtolower($player->getName()) . "'",
            SQLManager::REQUEST_GET
        ));
        while (!$reqTask->finished){}
        $deserialize = Serializer::jsonUnserialize($reqTask->getResult()[0]["spell"]);

        return new Session(
            (int)$reqTask->getResult()[0]["mana"],
            Spell::create((int)$deserialize[0], (int)$deserialize[1])
        );
    }

    /**
     * @param Player $player
     */
    public static function saveSqlSession(Player $player) : void {
        $session = self::getSession($player);

        Server::getInstance()->getAsyncPool()->submitTask(new SQLRequestAsync(
            "UPDATE `sessions` SET mana = '{$session->getMana()}', spell = '" . Serializer::jsonSerialize($session->getSpell()->toArray()) . "' WHERE username = '" . strtolower($player->getName()) . "'",
            SQLManager::REQUEST_WRITE
        ));
    }

    /**
     * @param Player $player
     *
     * @return Session
     */
    public static function createSqlSession(Player $player) : Session {
        $spell = Spell::create(0, Spell::TIER_1);

        Server::getInstance()->getAsyncPool()->submitTask(new SQLRequestAsync(
            "INSERT INTO `sessions` (username, mana, spell) VALUES ('" . strtolower($player->getName()) . "', '100', '" . Serializer::jsonSerialize($spell->toArray()) . "')",
            SQLManager::REQUEST_WRITE
        ));
        return new Session(100, $spell);
    }
}