<?php

namespace neptune\spells\form;

use pocketmine\form\Form as IForm;
use pocketmine\player\Player;

abstract class Form implements IForm {

    /** @var array $data */
    protected array $data = [];

    /** @var callable|null $callable */
    private $callable;

    public function __construct(?callable $callable){
        $this->callable = $callable;
    }

    /**
     * @param Player $player
     *
     * @deprecated
     */
    public function sendToPlayer(Player $player) : void {
        $player->sendForm($this);
    }

    /**
     * @return callable|null
     */
    public function getCallable() : ?callable {
        return $this->callable;
    }

    /**
     * @param callable|null $callable
     */
    public function setCallable(?callable $callable) : void {
        $this->callable = $callable;
    }

    /**
     * @param Player $player
     *
     * @param mixed $data
     */
    public function handleResponse(Player $player, $data) : void {
        $this->processData($data);
        $callable = $this->getCallable();

        if ($callable !== null)
            $callable($player, $data);
    }

    /**
     * @param $data
     */
    public function processData(&$data) : void {}

    /**
     * @return array|mixed
     */
    public function jsonSerialize(){
        return $this->data;
    }
}
