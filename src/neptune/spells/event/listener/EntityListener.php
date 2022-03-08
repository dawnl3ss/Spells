<?php

namespace neptune\spells\event\listener;

use neptune\spells\entity\TradeNPC;
use neptune\spells\form\FormList;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class EntityListener implements Listener {

    public function onDamage(EntityDamageByEntityEvent $ev){
        $player = $ev->getDamager();

         if ($ev->getEntity() instanceof TradeNPC and $player instanceof Player){
             FormList::sendTradeNPCForm($player);
             $ev->cancel();
         }
    }
}