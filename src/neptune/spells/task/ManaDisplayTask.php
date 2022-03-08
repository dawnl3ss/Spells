<?php

namespace neptune\spells\task;

use neptune\spells\Main;
use neptune\spells\network\session\SessionManager;
use neptune\spells\utils\message\Message;
use pocketmine\item\ItemIds;
use pocketmine\scheduler\Task;

class ManaDisplayTask extends Task {

    public function onRun() : void {
        foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $player){
            if ($player->isConnected() && SessionManager::hasSession($player)) {
                if ($player->getInventory()->getItemInHand()->getId() === ItemIds::STICK) {
                    $player->sendPopup(Message::get("MANA_POPUP_DISPLAY", [SessionManager::getSession($player)->getMana()]));
                } else continue;
            } else continue;
        }
    }
}