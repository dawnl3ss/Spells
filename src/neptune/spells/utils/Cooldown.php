<?php

namespace neptune\spells\utils;

use pocketmine\player\Player;

class Cooldown {

    /** @var array $spellChangeCooldown */
    public static array $interactCooldown = [];

    /**
     * @param Player $player
     *
     * @return bool
     */
    public static function canInteract(Player $player) : bool {
        if (isset(self::$interactCooldown[strtolower($player->getName())]) and time() - self::$interactCooldown[strtolower($player->getName())] < 2) {
            return false;
        } else {
            self::$interactCooldown[strtolower($player->getName())] = time();
            return true;
        }
    }
}