<?php

namespace neptune\spells\task;

use neptune\spells\event\ManaReceiveEvent;
use neptune\spells\Main;
use neptune\spells\utils\message\Message;
use pocketmine\scheduler\Task;

class ManaGiveTask extends Task {

    /** @var int $time */
    private $time = 5 * 60;

    public function onRun() : void {
        if ($this->time === 0){
            foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $player){
                (new ManaReceiveEvent(20, $player))->call();
                $player->sendMessage(Message::get("MANA_RECEIVE", [20]));
            }
            $this->time = 5 * 60;
        } else $this->time--;
    }
}