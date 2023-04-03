<?php

namespace Herrschnecki;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use WolfDen133\ServerSettings\ServerSettings;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->notice("Plugin wurde aktiviert!");

        $api = $this->getServer()->getPluginManager()->getPlugin("ServerSettings");

        if ($api === null) {
            $this->getLogger()->error("ServerSettings plugin not found!");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $api->getServerSettingsAPI()->register($this);

        $api->getServerSettings()->setTitle("Server Settings");
        $api->getServerSettings()->setIcon(ServerSettings::TYPE_PATH, "textures/ui/settings_glyph_color_2x");
        $api->getServerSettings()->addLabel("This is where your settings will be");
        $api->getServerSettings()->addToggle("Scoreboard");
        $api->getServerSettings()->addDropdown("Language", ["English", "French", "German", "Spanish"]);
        $api->getServerSettings()->addStepSlider("Player Visibility", ["Everyone", "Friends & Party", "No one"]);

        $api->getServerSettings()->setCallable(function (Player $player, array $data = null): void {
            if ($data === null) return;
            // Your methods here
            // Data is presented as an array with the order of which you set it as, much like a custom form from jojoe77777/FormAPI
        });
    }

    public function onDisable(): void {
        $this->getLogger()->notice("Plugin wurde deaktiviert!");
    }
}
