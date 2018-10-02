<?php

namespace Fly;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable() {
        
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
        if (strtolower($cmd->getName()) === "fly")
            if (empty($args)) {
                if (!$sender->hasPermission("fly.me")) {
                    $sender->sendMessage(TextFormat::RED . "Chế không có quyền bay đâu, ahihi!");
                    return true;
                } else {
                    if (!$sender instanceof Player) {
                        $sender->sendMessage(TextFormat::RED . "Command only allowed in-game");
                        return true;
                    }
                    if ($sender->getAllowFlight()) {
                        $sender->setAllowFlight(false);
                        $sender->sendMessage(TextFormat::RED . "Rơi xuống kìa!!! ");
                        return true;
                    } else {
                        $sender->setAllowFlight(true);
                        $sender->sendMessage(TextFormat::GREEN . "Bay như 1 con chim đi!");
                        return true;
                    }
                }
            } else if (count($args === 1)) {
                $player = $this->getServer()->getPlayer($args[0]);
                if (!$sender->hasPermission("fly.others")) {
                    $sender->sendMessage(TextFormat::RED . "Chế không có quyền cho người khác bay đâu, ahihi!");
                    return true;
                } else {
                    if ($player === null) {
                        $sender->sendMessage(TextFormat::RED . "Player not online");
                        return true;
                    }
                    if ($player->getAllowFlight()) {
                        $player->setAllowFlight(false);
                        $player->sendMessage(TextFormat::RED . "Rơi xuống kìa!!!");
                        $sender->sendMessage(TextFormat::RED . "1 thanh niên hạ cánh: " . TextFormat::WHITE . $player->getName());
                        return true;
                    } else {
                        $player->setAllowFlight(true);
                        $player->sendMessage(TextFormat::GREEN . "Bay như 1 con chim đi!");
                        $sender->sendMessage(TextFormat::GREEN . "1 thanh niên đã được bay!: " . TextFormat::WHITE . $player->getName());
                        return true;
                    }
                }
            }
        return false;
    }

}
