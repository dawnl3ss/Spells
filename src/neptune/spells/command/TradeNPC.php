<?php

namespace neptune\spells\command;

use neptune\spells\utils\message\Message;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\PluginsCommand;
use pocketmine\entity\Location;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use neptune\spells\entity\TradeNPC as EntityTradeNPC;

class TradeNPC extends PluginsCommand {

    public function __construct(){
        parent::__construct("spawnspellnpc");
        $this->setDescription("Faire spawn le NPC de sorts");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args){
        if ($player instanceof Player){
            if ($player->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
                $entity = new EntityTradeNPC(Location::fromObject($player->getLocation(), $player->getWorld()));
                $entity->spawnToAll();
                $player->sendMessage(Message::get("SPELL_NPC_SPAWN_SUCCESS", []));
            } else $player->sendMessage(Message::get("COMMAND_NOT_ALLOWED", []));
        }
    }
}