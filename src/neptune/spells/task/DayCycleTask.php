<?php

namespace neptune\spells\task;

use neptune\spells\entity\TradeNPC;
use neptune\spells\utils\DateManager;
use pocketmine\scheduler\Task;

class DayCycleTask extends Task {

    public function onRun() : void {
        if (DateManager::checkDay()){
            var_dump('done !');
            TradeNPC::setTrades();
        }
    }
}