<?php

namespace neptune\spells\utils;

use neptune\spells\command\TradeNPC as CTradeNPC;
use neptune\spells\command\Test;
use neptune\spells\entity\TradeNPC;
use neptune\spells\event\listener\EntityListener;
use neptune\spells\event\listener\PlayerListener;
use neptune\spells\event\listener\SpellListener;
use neptune\spells\Main;
use neptune\spells\network\SQLManager;
use neptune\spells\task\DayCycleTask;
use neptune\spells\task\ManaDisplayTask;
use neptune\spells\task\ManaGiveTask;
use pocketmine\command\PluginCommand;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\event\Listener;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;

class Loader {

    /** @var Listener[] $listeners */
    private static array $listeners = [SpellListener::class, PlayerListener::class, EntityListener::class];

    /** @var PluginCommand[] $commands */
    private static array $commands = [Test::class, CTradeNPC::class];

    public static function __init_listeners() : void {
        foreach (self::$listeners as $listener)
            Main::getInstance()->getServer()->getPluginManager()->registerEvents(new $listener(), Main::getInstance());
    }

    public static function __init_commands() : void {
        foreach (self::$commands as $fallback => $command)
            Main::getInstance()->getServer()->getCommandMap()->register($fallback, new $command());
    }

    public static function __init_tasks() : void {
        Main::getInstance()->getScheduler()->scheduleRepeatingTask(new ManaGiveTask(), 20);
        Main::getInstance()->getScheduler()->scheduleRepeatingTask(new ManaDisplayTask(), 15);
        Main::getInstance()->getScheduler()->scheduleRepeatingTask(new DayCycleTask(), 20 * 60);
    }

    public static function __init_entities() : void {
        EntityFactory::getInstance()->register(TradeNPC::class, function(World $world, CompoundTag $nbt) : TradeNPC {
            return new TradeNPC(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
        }, ["TradeNPC", "minecraft:trade_npc"], EntityLegacyIds::VILLAGER);
        TradeNPC::setTrades();
    }

    public static function __init_sql() : void {
        SQLManager::createData(SQLManager::DATABASE_SPELLS);
    }
}