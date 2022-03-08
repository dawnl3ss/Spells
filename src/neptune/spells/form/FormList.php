<?php

namespace neptune\spells\form;

use pocketmine\player\Player;

class FormList {

    /**
     * @param Player $player
     */
    public static function sendTradeNPCForm(Player $player) : void {
        $form = new SimpleForm(function (Player $player, $data){});
        $form->setTitle("NPC Spells");
        $form->addButton("Close");
        $player->sendForm($form);
    }
}