<?php

namespace neptune\spells\spell;

interface Tiers {

    public const TIER_1 = 1;
    public const TIER_2 = 2;
    public const TIER_3 = 3;

    public const ALL_SPELLS = [
        self::SPELL_REPULSION,
        self::SPELL_ATTRACTION,
        self::SPELL_FREEZE,
        self::SPELL_ECLAIRUS,
    ];

    public const SPELL_REPULSION = [
        "id" => 0,
        "name" => "Repulsion"
    ];
    public const SPELL_ATTRACTION = [
        "id" => 1,
        "name" => "Attraction"
    ];
    public const SPELL_FREEZE = [
        "id" => 2,
        "name" => "Freeze"
    ];
    public const SPELL_ECLAIRUS = [
        "id" => 3,
        "name" => "Eclairus"
    ];
}