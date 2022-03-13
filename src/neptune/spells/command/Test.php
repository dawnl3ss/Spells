<?php

namespace neptune\spells\command;

use neptune\spells\entity\TradeNPC;
use neptune\spells\network\Serializer;
use neptune\spells\network\session\SessionManager;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\PluginsCommand;
use pocketmine\entity\Location;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class Test extends PluginsCommand {

    public function __construct(){
        parent::__construct("test");
        $this->setDescription("Commande de test");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args) : void {
        if ($player instanceof Player){
            $player->sendMessage("Spell : " . Serializer::jsonSerialize(SessionManager::getSession($player)->getSpell()->toArray()));
            $player->sendMessage("Mana : " . SessionManager::getSession($player)->getMana());

            /*$entity = new TradeNPC(Location::fromObject($player->getLocation(), $player->getWorld()));
            $entity->spawnToAll();
            TradeNPC::setTrades();*/
        }
    }
}