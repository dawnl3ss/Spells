<?php

namespace neptune\spells\spell\type;

use neptune\spells\event\ManaLoseEvent;
use neptune\spells\network\session\SessionManager;
use neptune\spells\spell\Spell;
use neptune\spells\utils\message\Message;
use neptune\spells\world\Particles;
use pocketmine\player\Player;

class Repulsion extends Spell {

    /** @var int $cost */
    private int $cost = 20;

    public function __construct(int $tier = 1){
        parent::__construct(self::SPELL_REPULSION["name"], self::SPELL_REPULSION["id"], $tier);
    }

    /**
     * @param Player $player
     */
    public function onActivate(Player $player) : void {
        if (SessionManager::hasSession($player)) {
            if (SessionManager::getSession($player)->getMana() - $this->cost >= 0) {
                foreach ($player->getViewers() as $viewer) {
                    $deltaX = abs($player->getPosition()->getX() - $viewer->getPosition()->getX());
                    $deltaZ = abs($player->getPosition()->getZ() - $viewer->getPosition()->getZ());

                    if (($deltaX < $this->getTier() * 5) && ($deltaZ < $this->getTier() * 5)) {
                        $diff = $viewer->getPosition()->subtractVector($player->getPosition());
                        $viewer->knockBack($diff->x, $diff->z, 1);
                    }
                }
                $this->reduceMana($player);
                Particles::displayParticles(self::SPELL_REPULSION["id"], $player);
            } else $player->sendMessage(Message::get("NOT_ENOUGH_MANA", []));
        }
    }

    /**
     * @param Player $player
     */
    public function reduceMana(Player $player) : void { (new ManaLoseEvent($this->cost, $player))->call(); }
}