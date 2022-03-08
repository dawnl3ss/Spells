<?php

namespace neptune\spells\entity;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class TradeNPC extends Living {

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
}