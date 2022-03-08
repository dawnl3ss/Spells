<?php

namespace neptune\spells\spell\type;

use neptune\spells\event\ManaReceiveEvent;
use neptune\spells\Main;
use neptune\spells\network\session\SessionManager;
use neptune\spells\spell\Spell;
use neptune\spells\utils\message\Message;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\player\Player;

class Eclairus extends Spell {

    /** @var int $cost */
    private int $cost = 20;

    public function __construct(int $tier = 1){
        parent::__construct(self::SPELL_ECLAIRUS["name"], self::SPELL_ECLAIRUS["id"], $tier);
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
                        $pk = new AddActorPacket();
                        $pk->type = "minecraft:lightning_bolt";
                        $pk->actorRuntimeId = $viewer->getId() + 1;
                        $pk->actorUniqueId = mt_rand($viewer->getId() + 2, $player->getId() + 9999);
                        $pk->position = $viewer->getPosition();
                        Main::getInstance()->getServer()->broadcastPackets($player->getWorld()->getPlayers(), [$pk]);
                        $viewer->attack(new EntityDamageByEntityEvent($player, $viewer, EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK, $this->getTier() * 3));
                    }
                }
                $this->reduceMana($player);
            } else $player->sendMessage(Message::get("NOT_ENOUGH_MANA", []));
        }
    }

    /**
     * @param Player $player
     */
    public function reduceMana(Player $player) : void { (new ManaReceiveEvent(-$this->cost, $player))->call(); }
}