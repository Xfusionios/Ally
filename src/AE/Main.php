<?php
namespace AE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener{
	public $active = array();
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
@mkdir($this->getDataFolder()."Players/");	
	}
	
	
public function onPlayerLogin(PlayerPreLoginEvent $event){
        $ign = $event->getPlayer()->getName();
        $player = $event->getPlayer();
        $file = ($this->getDataFolder()."Players/".$ign.".yml");  
            if(!file_exists($file)){
                $this->PlayerFile = new Config($this->getDataFolder()."Players/".$ign.".yml", Config::YAML);
                $this->PlayerFile->set($player->getName()." Allies!");
                $this->PlayerFile->save();
            }
        }
        
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
 if(strtolower($cmd->getName()) === "ally") {
            if(isset($args[0]) && isset($args[1])){
                $name = $args[0];
                $target = $this->getServer()->getPlayer($name);
                if($sender instanceof Player){
                if($target === null){
                	$sender->sendMessage("that player is not online!");
                	return false;
                }
                if($target instanceof Player){
                $sender->sendMessage("Ally request sent to".$target->getName());
                 $target->sendMessage($sender->getName()." Wants to be allys! please do /accept to accpet thier allyship request!");
                $task = new accept($this, $target);
		 	$this->getServer()->getScheduler()->scheduleDelayedTask($task, 600);
		 	return true;
            }
                }else{
                	$sender->sendMessage("Please do this command in game!");
                	return false;
                }
                }
 }
}
            
        
