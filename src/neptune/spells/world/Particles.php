<?php

namespace neptune\spells\world;

use neptune\spells\spell\Spell;
use pocketmine\player\Player;
use pocketmine\world\particle\SmokeParticle;

class Particles {

    public static function displayParticles(int $spellId, Player $player) : void {
        switch ($spellId){
            case Spell::SPELL_REPULSION["id"]:
                for ($x = -5; $x < 5; $x++){
                    for ($z = -5; $z < 5; $z++) {
                        $player->getWorld()->addParticle($player->getPosition()->add($x, 0, $z), new SmokeParticle());
                    }
                }
                break;
            case Spell::SPELL_ATTRACTION["id"]:
                for ($x = -5; $x < 5; $x++){
                    for ($z = -5; $z < 5; $z++) {
                        $player->getWorld()->addParticle($player->getPosition()->add($x, 0, $z), new SmokeParticle());
                    }
                }
                break;
            case Spell::SPELL_FREEZE["id"]:
                for ($x = -5; $x < 5; $x++){
                    for ($z = -5; $z < 5; $z++) {
                        $player->getWorld()->addParticle($player->getPosition()->add($x, 0, $z), new SmokeParticle());
                    }
                }
                break;
        }
    }
}