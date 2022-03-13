<?php

namespace neptune\spells\world;

use neptune\spells\Main;
use neptune\spells\spell\Spell;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\player\Player;
use pocketmine\world\particle\SmokeParticle;

class Particles {

    public static function displayParticles(int $spellId, Player $player, ?Player $viewer = null) : void {
        switch ($spellId){
            case Spell::SPELL_REPULSION["id"]:

                break;
            case Spell::SPELL_ATTRACTION["id"]:

                break;
            case Spell::SPELL_FREEZE["id"]:
                for ($x = -5; $x < 5; $x++){
                    for ($z = -5; $z < 5; $z++) {
                        $player->getWorld()->addParticle($player->getPosition()->add($x, 0, $z), new SmokeParticle());
                    }
                }
                break;
            case Spell::SPELL_ECLAIRUS["id"]:
                $pk = new AddActorPacket();
                $pk->type = "minecraft:lightning_bolt";
                $pk->actorRuntimeId = $viewer->getId() + 1;
                $pk->actorUniqueId = mt_rand($viewer->getId() + 2, $player->getId() + 9999);
                $pk->position = $viewer->getPosition();
                Main::getInstance()->getServer()->broadcastPackets($player->getWorld()->getPlayers(), [$pk]);
                break;
        }
    }
}