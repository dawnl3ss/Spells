<?php

namespace neptune\spells\entity;

use neptune\spells\spell\Spell;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class TradeNPC extends Living {

    /** @var Spell[] $dailySpells */
    public static array $dailySpells = [];

    /**
     * @return string
     */
    public static function getNetworkTypeId() : string { return EntityIds::VILLAGER; }

    /**
     * @return EntitySizeInfo
     */
    protected function getInitialSizeInfo() : EntitySizeInfo { return new EntitySizeInfo(1.95, 0.6); }

    /**
     * @return bool
     */
    public function canBeCollidedWith() : bool { return false; }

    /**
     * @return bool
     */
    public function canBeMovedByCurrents() : bool { return false; }

    /**
     * @return string
     */
    public function getName() : string { return "Spell NPC"; }

    /**
     * @param CompoundTag $nbt
     */
    public function initEntity(CompoundTag $nbt) : void {
        $this->setNameTag($this->getName());
        $this->setNameTagAlwaysVisible();
        parent::initEntity($nbt);
    }

    public static function setTrades() : void {
        self::$dailySpells = [];

        array_push(self::$dailySpells, Spell::create(
            mt_rand(0, count(Spell::ALL_SPELLS) - 1),
            Spell::TIER_1
        ));
        array_push(self::$dailySpells, Spell::create(
            mt_rand(0, count(Spell::ALL_SPELLS) - 1),
            Spell::TIER_2
        ));
        array_push(self::$dailySpells, Spell::create(
            mt_rand(0, count(Spell::ALL_SPELLS) - 1),
            Spell::TIER_3
        ));
    }
}