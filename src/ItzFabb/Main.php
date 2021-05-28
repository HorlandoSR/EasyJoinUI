<?php

namespace ItzFabb;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\math\Vector3;
use pocketmine\level\Position;

use pocketmine\level\Level;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;


class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info("§bFormAPI Detected §aEnabling §bAcidmenu by ItzFabb");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);      
        
        @mkdir($this->getDataFolder());
	$this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onLoad(){
        $this->getLogger()->info("§eLoading please wait");
    }

    public function onDisable(){
        $this->getLogger()->info("§4FormAPI Didnt detected §cDisabling Acidmenu");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "acidmenu":
                if($sender instanceof Player){
                    $this->mainform($sender);
                }else{
                    $sender->sendMessage("§cPlease use this command in-game");
                } 
                break;
        }
        return true;
    }
        

	public function mainform($sender){

      	$form = new SimpleForm(function (Player $sender, $data){

            $result = $data;

            if ($result == null) {

            }

            switch ($result) {

				case 0:
				break;
				
				case 1:
		
				    $this->getServer()->getCommandMap()->dispatch($sender, "acidisland create");
				    $sender->sendMessage($this->cfg->get("MSG-CREATE"));
				
				break;
				
                case 2:
                
                     $this->getServer()->getCommandMap()->dispatch($sender, "acidisland join");
                     $sender->sendMessage($this->cfg->get("MSG-TELEPORT"));
                     $sender->addTitle($this->cfg->get("MSG-TELEPORT"));
                     
                break;
                
                case 3:
                
                     $this->invitemember($sender);
                     
                break;
                
                case 4:
                
                     $this->kickmember($sender);
                
                break;
                
                case 5;
                
                    $this->getServer()->getCommandMap()->dispatch($sender, "acidisland lock");
                
                break;
                
                case 6;
                
                    $this->getServer()->getCommandMap()->dispatch($sender, "is disband");
                
                break;
                
                case 7;
                
                    $this->getServer()->getCommandMap()->dispatch($sender, "acidisland blocks");
                
                break;
                
                case 8;
                
                    $this->getServer()->getCommandMap()->dispatch($sender, "acidisland leave");
                
                break;
                
           
			}

		});

		$form->setTitle($this->cfg->get("TITLE-ACIDUI"));

		$form->setContent($this->cfg->get("CONTENT-ACIDUI"));

		$form->addButton($this->cfg->get("BTN-EXT"), 0, "textures/ui/cancel");

        $form->addButton($this->cfg->get("BTN-CRT"), 0, "textures/ui/mashup_world");
        
        $form->addButton($this->cfg->get("BTN-TP"), 0, "textures/ui/icon_import");
        
        $form->addButton($this->cfg->get("BTN-INV"), 0, "textures/ui/invite_hover");
        
        $form->addButton($this->cfg->get("BTN-OUT"), 0, "textures/ui/speed_effect");
        
        $form->addButton($this->cfg->get("BTN-LCK"), 0, "textures/ui/lock_color");
        
        $form->addButton($this->cfg->get("BTN-DLT"), 0, "textures/ui/icon_trash");
        
        $form->addButton($this->cfg->get("BTN-BLK"), 0, "textures/ui/copy");
        
        $form->addButton($this->cfg->get("BTN-LFT"), 0, "textures/ui/icon_trending");
        
		$form->sendToPlayer($sender);

		return true;

		

	}
	public function invitemember($sender){
      	$form = new CustomForm(function (Player $sender, $data){

            if($data !== null){
				
			    $this->getServer()->getCommandMap()->dispatch($sender, "acidisland invite $data[0]");
		
				}

		});

		$form->setTitle($this->cfg->get("TITLE-ADDMEMBER"));

        $form->addInput($this->cfg->get("INPUT-ADDMEMBER"));
        
		$form->sendToPlayer($sender);
		
		}
		public function kickmember($sender){

      	$form = new CustomForm(function (Player $sender, $data){

            if($data !== null){
            	
				$this->getServer()->getCommandMap()->dispatch($sender, "acidisland fire $data[0]");
				
				}

		});

		$form->setTitle($this->cfg->get("TITLE-KICKMEMBER"));

        $form->addInput($this->cfg->get("INPUT-KICKMEMBER"));
        
		$form->sendToPlayer($sender);
		return true;

		

	}
}