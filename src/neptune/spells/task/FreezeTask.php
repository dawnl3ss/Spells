<?php

namespace neptune\spells\task;

use neptune\spells\utils\message\Message;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class FreezeTask extends Task {

    /** @var Player[] $players */
    private array $players;

    /** @var int $time */
    private int $time;

    public function __construct(array $players, int $time){
        $this->players = $players;
        $this->time = $time;
    }

    public function onRun() : void {
        if ($this->time === 0){
            foreach ($this->players as $player){
                if ($player->isConnected()){
                    $player->setImmobile(false);
                    $player->sendTip(Message::get("PLAYER_UNFREEZE_POPUP", []));
                } else continue;
            }
            $this->getHandler()->cancel();
        } else $this->time--;
    }
}