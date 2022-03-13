<?php

namespace neptune\spells\utils\message;

interface Dictionary {

    public const MESSAGES = [
        "MANA_RECEIVE" => "§aTu as reçu % de mana !",
        "NOT_ENOUGH_MANA" => "§cVous n'avez pas assez de mana.",
        "MANA_POPUP_DISPLAY" => "§l§6MANA: [%/100]",

        "PLAYER_FREEZE_POPUP" => "§bVous êtes gelé !",
        "PLAYER_UNFREEZE_POPUP" => "§aVous n'êtes plus gelé !",

        "PLAYER_HIT_BY_SPELL" => "§cVous venez d'être touché par le sort % de tier % !",
        "PLAYER_SWITCH_SPELL" => "§bVous venez de changer de sort : % !",
        "PLAYER_USE_SPELL" => "§bVous venez d'utiliser le sort % !",

        "SPELL_NPC_SPAWN_SUCCESS" => "§aVous avez bien fait spawn le NPC des sorts.",
        "SPELL_BUY_SUCCES" => "§aVous avez bien acheté le sort % de tier % !",
        "SPELL_BUY_DENIED" => "§cVous n'avez pas assez d'ingredients pour acheter ce sort !",

        "COMMAND_NOT_ALLOWED" => "§cVous n'êtes pas autorisé à effectuer cette commande."
    ];
}