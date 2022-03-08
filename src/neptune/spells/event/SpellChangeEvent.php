<?php

namespace neptune\spells\event;

use neptune\spells\Main;
use neptune\spells\spell\Spell;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\player\Player;

class SpellChangeEvent extends PluginEvent {

    /** @var Spell $oldSpell */
    private Spell $oldSpell;

    /** @var Spell $newSpell */
    private Spell $newSpell;

    /** @var Player $player */
    private Player $player;

    public function __construct(Spell $oldSpell, Spell $newSpell, Player $player){
        parent::__construct(Main::getInstance());
        $this->oldSpell = $oldSpell;
        $this->newSpell = $newSpell;
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player { return $this->player; }

    /**
     * @return Spell
     */
    public function getOldSpell() : Spell { return $this->oldSpell; }

    /**
     * @return Spell
     */
    public function getNewSpell() : Spell { return $this->newSpell; }
}