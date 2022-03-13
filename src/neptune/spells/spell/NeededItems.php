<?php

namespace neptune\spells\spell;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class NeededItems implements Tiers {

    /** @var Item[] $items */
    private array $items;

    public function __construct(int $tier){
        switch ($tier) {
            case self::TIER_1:
                $this->items = [
                    ItemFactory::getInstance()->get(ItemIds::COBBLESTONE, 0, 32),  //pierre de magie
                    ItemFactory::getInstance()->get(ItemIds::DIAMOND, 0, 15),      // mithril
                    ItemFactory::getInstance()->get(ItemIds::EMERALD, 0, 10)       // jade
                ];
                break;
            case self::TIER_2:
                $this->items = [
                    ItemFactory::getInstance()->get(ItemIds::COBBLESTONE, 0, 64),  //pierre de magie
                    ItemFactory::getInstance()->get(ItemIds::DIAMOND, 0, 30),      // mithril
                    ItemFactory::getInstance()->get(ItemIds::EMERALD, 0, 30)       // jade
                ];
                break;
            case self::TIER_3:
                $this->items = [
                    ItemFactory::getInstance()->get(ItemIds::COBBLESTONE, 0, 128),  //pierre de magie
                    ItemFactory::getInstance()->get(ItemIds::DIAMOND, 0, 120),      // mithril
                    ItemFactory::getInstance()->get(ItemIds::EMERALD, 0, 80)        // jade
                ];
                break;
        }
    }

    /**
     * @return Item[]
     */
    public function get() : array { return $this->items; }

    /**
     * @param Player $player
     *
     * @return bool
     */
    public function has(Player $player) : bool {
        $has = [];

        foreach ($this->get() as $item){
            array_push($has, $player->getInventory()->contains($item));
        }
        return !in_array(false, $has);
    }

    /**
     * @param Player $player
     */
    public function removeItems(Player $player) : void {
        foreach ($this->get() as $item){
            $player->getInventory()->removeItem($item);
        }
    }
}