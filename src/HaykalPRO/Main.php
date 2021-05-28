<?php

namespace HaykalPRO;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\level\Level;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;


class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info("§bFormAPI Detected §aEnabling §bEasyJoinUI");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);      
        
        @mkdir($this->getDataFolder());
	$this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onLoad(){
        $this->getLogger()->info("§eLoading please wait");
    }

    public function onDisable(){
        $this->getLogger()->info("§4FormAPI Didnt detected §cDisabling EasyJoinUI");
    }

public function JoinMenuUiForm(Player $player)
{
    $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null) {
        if ($data === null) {
            return;
        }
        switch ($data) {
            case 1:
                $sender->sendMessage($this->cfg->get("MSG-ONE"));
            break;
            case 2:
                $sender->sendMessage($this->cfg->get("MSG-TWO"));
            break;
        }
    });
    $form->addTitle($this->cfg->get("TITLE-JOINUI"));
    $form->setContent($this->cfg->get("CONTENT-JOINUI"));
    $form->addButton($this->cfg->get("BUTTON-ONE"));
    $form->addButton($this->cfg->get("BUTTON-TWO"));
    $form->sendToPlayer($player);
    return $form;
}

public function GodWeedZao(PlayerJoinEvent $event) {
    if ($event->getPlayer() instanceof Player) {
        $this->JoinMenuUiForm($event->getPlayer());
        
    }
}