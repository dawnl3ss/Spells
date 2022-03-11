<?php

namespace neptune\spells\event;

use neptune\spells\Main;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\player\Player;

class ManaLoseEvent extends PluginEvent {

    /** @var int $amount */
    private int $amount;

    /** @var Player $player */
    private Player $player;

    public function __construct(int $amout, Player $player){
        parent::__construct(Main::getInstance());
        $this->amount = $amout;
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player { return $this->player; }

    /**
     * @return int
     */
    public function getAmount() : int { return $this->amount; }
}