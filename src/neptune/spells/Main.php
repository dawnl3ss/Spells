<?php

namespace neptune\spells;

use neptune\spells\utils\Loader;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    /** @var Main $instance */
    private static Main $instance;

    /** @var string $prefix */
    public static string $prefix  = "";

    public function onEnable() : void {
        self::$instance = $this;

        Loader::__init_listeners();
        Loader::__init_entities();
        Loader::__init_commands();
        Loader::__init_tasks();
        Loader::__init_sql();
    }

    /**
     * @return Main
     */
    public static function getInstance() : Main { return self::$instance; }
}