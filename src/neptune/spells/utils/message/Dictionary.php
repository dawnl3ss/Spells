<?php

namespace neptune\spells\utils\message;

interface Dictionary {

    public const MESSAGES = [
        "MANA_RECEIVE" => "§aTu as reçu % de mana !",
        "NOT_ENOUGH_MANA" => "§cVous n'avez pas assez de mana.",
        "MANA_POPUP_DISPLAY" => "§l§6MANA: [%/100]",

        "PLAYER_FREEZE_POPUP" => "§bVous êtes gelé !",
        "PLAYER_UNFREEZE_POPUP" => "§aVous n'êtes plus gelé !",

        "SPELL_NPC_SPAWN_SUCCESS" => "§aVous avez bien fait spawn le NPC des sorts.",
        "SPELL_BUY_SUCCES" => "§aVous avez bien acheté le sort % de tier % !",
        "SPELL_BUY_DENIED" => "§cVous n'avez pas assez d'ingredients pour acheter ce sort !",

        "COMMAND_NOT_ALLOWED" => "§cVous n'êtes pas autorisé à effectuer cette commande."
    ];
}