<?php

namespace neptune\spells\event\listener;

use neptune\spells\network\session\SessionManager;
use neptune\spells\utils\Cooldown;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class PlayerListener implements Listener {

    public function onJoin(PlayerJoinEvent $ev){
        $player = $ev->getPlayer();

        if (!$player->hasPlayedBefore()) $session = SessionManager::createSqlSession($player);
        else $session = SessionManager::getSqlSession($player);
        SessionManager::addSession($player, $session);
    }

    public function onLeave(PlayerQuitEvent $ev){
        $player = $ev->getPlayer();
        if (SessionManager::hasSession($player)){
            SessionManager::saveSqlSession($player);
            SessionManager::deleteSession($player);
        }
    }

    public function onInteract(PlayerInteractEvent $ev){
        $player = $ev->getPlayer();

        if (Cooldown::canInteract($player)){
            if ($ev->getAction() === $ev::LEFT_CLICK_BLOCK || $ev->getAction() === $ev::RIGHT_CLICK_BLOCK) {
                if ($player->isSneaking()){
                    //TODO: switch de spell
                    /*$$session = SessionManager::getSession($player);
                    $session->setSpell(Spell::create($session->getSpell()->getId() + 1, Spell::TIER_1));
                    $player->sendMessage("switch");*/

                    SessionManager::getSession($player)->getSpell()->onActivate($player);
                }
            }
        }
    }
}