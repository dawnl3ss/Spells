<?php

namespace neptune\spells\network\session;

use neptune\spells\spell\Spell;

class Session {

    /** @var int $mana */
    private int $mana;

    /** @var Spell $spell */
    private Spell $spell;

    public function __construct(int $mana, Spell $spell){
        $this->mana = $mana;
        $this->spell = $spell;
    }

    /**
     * @return int
     */
    public function getMana() : int { return $this->mana; }

    /**
     * @param int $amount
     */
    public function setMana(int $amount) : void { $this->mana = $amount; }

    /**
     * @return Spell
     */
    public function getSpell() : Spell { return $this->spell; }

    /**
     * @param Spell $spell
     */
    public function setSpell(Spell $spell) : void { $this->spell = $spell; }

}