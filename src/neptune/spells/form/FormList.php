<?php

namespace neptune\spells\form;

use neptune\spells\entity\TradeNPC;
use neptune\spells\event\SpellChangeEvent;
use neptune\spells\network\session\SessionManager;
use neptune\spells\spell\Spell;
use neptune\spells\utils\message\Message;
use pocketmine\player\Player;

class FormList {

    /**
     * @param Player $player
     */
    public static function sendTradeNPCForm(Player $player) : void {
        $form = new SimpleForm(function (Player $player, $data){
            foreach (TradeNPC::$dailySpells as $index => $spell){
                switch ($data) {
                    case $index + 1:
                        self::sendBuySpellForm($player, $spell);
                        break;
                }
            }
        });
        $form->setTitle("NPC Spells");
        $form->addButton("§cRetour");

        foreach (TradeNPC::$dailySpells as $spell){
            $form->addButton("§a" . $spell->getName() . "\n§6Tier : " . $spell->getTier());
        }
        $player->sendForm($form);
    }

    public static function sendBuySpellForm(Player $player, Spell $spell) : void {
        $form = new SimpleForm(function (Player $player, $data) use ($spell){
            switch ($data) {
                case 0:
                    self::sendTradeNPCForm($player);
                    break;
                case 1:
                    if ($spell->getNeededItems()->has($player)){
                        $spell->getNeededItems()->removeItems($player);
                        (new SpellChangeEvent(SessionManager::getSession($player)->getSpell(), $spell, $player))->call();
                        $player->sendMessage(Message::get("SPELL_BUY_SUCCES", [$spell->getName(), $spell->getTier()]));
                    } else $player->sendMessage(Message::get("SPELL_BUY_DENIED", []));
                    break;
            }
        });
        $form->setTitle("NPC Spells");
        $form->setContent("Voulez vous vraiment acheter le sort :\n{$spell->getName()} de tier {$spell->getTier()}");
        $form->addButton("§cNon");
        $form->addButton("§aOui");
        $player->sendForm($form);
    }
}