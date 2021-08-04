<?php

namespace HaykalPRO;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;


class Main extends PluginBase implements Listener{
  
  public function onEnable(){
        $this->getLogger()->info("§aPlugin EasyJoinUI Enable");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);

        @mkdir($this->getDataFolder());
       $this->saveDefaultConfig();
       $this->getResource("config.yml");
  }

  public function onLoad(){
        $this->getLogger()->info("§eLoading please wait");
  }

  public function onDisable(){
        $this->getLogger()->info("§4FormAPI Didnt detected §cDisabling EasyJoinUI");
  }
    
  public function onJoin(PlayerJoinEvent $e){
    $player = $e->getPlayer();
    
    $this->getServer()->broadcastMessage($this->replace($player, $this->getConfig()->get("join-message")));
  $this->join($player);
  }

  public function join($player){
    $form = new SimpleForm(function(Player $player, int $data = null){
      if($data === null){
        return true;
      }
      switch ($data) {
      }   
    });
    $form->setTitle($this->replace($player, $this->getConfig()->get("title")));
    $form->setContent($this->replace($player, $this->getConfig()->get("content")));
    $form->addButton($this->replace($player, $this->getConfig()->get("button")));
    $form->sendToPlayer($player);
    return $form;
    }
  
  private function replace(Player $player, string $text) : string {
		$from = ["{name}"];
		$to = [
			$player->getName()
		];
		return str_replace($from, $to, $text);
	}
  }
