<?php

namespace neptune\spells\spell;

use neptune\spells\spell\type\Attraction;
use neptune\spells\spell\type\Eclairus;
use neptune\spells\spell\type\Freeze;
use neptune\spells\spell\type\Repulsion;
use pocketmine\player\Player;

abstract class Spell implements Tiers {

    /** @var string $name */
    private string $name;

    /** @var int $id */
    private int $id;

    /** @var int $tier */
    private int $tier;

    /** @var int $cost */
    private int $cost;

    public function __construct(string $name, int $id, int $tier = 1){
        $this->name = $name;
        $this->id = $id;
        $this->tier = $tier;
    }

    /**
     * @return string
     */
    public function getName() : string { return $this->name; }

    /**
     * @return int
     */
    public function getId() : int { return $this->id; }

    /**
     * @return int
     */
    public function getTier() : int { return $this->tier; }

    /**
     * @return array
     */
    public function toArray() : array { return [$this->id, $this->tier, $this->name]; }

    /**
     * @param Player $player
     */
    abstract public function onActivate(Player $player) : void ;

    /**
     * @param int $id
     *
     * @return Spell
     */
    public static function create(int $id, int $tier) : Spell {
        switch ($id){
            case self::SPELL_REPULSION["id"]:
                return new Repulsion($tier);
            case self::SPELL_ATTRACTION["id"]:
                return new Attraction($tier);
            case self::SPELL_FREEZE["id"]:
                return new Freeze($tier);
            case self::SPELL_ECLAIRUS["id"]:
                return new Eclairus($tier);
        }
    }
}