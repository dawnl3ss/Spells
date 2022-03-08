<?php

namespace neptune\spells\event\listener;

use neptune\spells\event\ManaReceiveEvent;
use neptune\spells\event\SpellChangeEvent;
use neptune\spells\network\session\SessionManager;
use pocketmine\event\Listener;

class SpellListener implements Listener {

    public function onSpellChange(SpellChangeEvent $ev){
        $player = $ev->getPlayer();

        if (SessionManager::hasSession($player)){
            SessionManager::getSession($player)->setSpell($ev->getNewSpell());
        }
    }

    public function onManaReceive(ManaReceiveEvent $ev){
        if (SessionManager::hasSession($ev->getPlayer())) {
            $session = SessionManager::getSession($ev->getPlayer());

            if (($session->getMana() + $ev->getAmount()) <= 100) {
                $session->setMana($session->getMana() + $ev->getAmount());
                return;
            } else $session->setMana(100);

            if (($session->getMana() + $ev->getAmount()) >= 0) {
                $session->setMana($session->getMana() + $ev->getAmount());
                return;
            } else $session->setMana(0);
        }
    }
}