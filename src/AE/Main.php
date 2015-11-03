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
	public $request = array();
	public $queue = array();
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
                $this->TargetFile = new Config($this->getDataFolder()."Players/".$target->getName().".yml", Config::YAML);
                $this->SenderFile = new Config($this->getDataFolder()."Players/".$sender->getName().".yml", Config::YAML);
                
                if($sender instanceof Player){
                if($target === null){
                	$sender->sendMessage("that player is not online!");
                	return false;
                }
                if($target instanceof Player){
                $sender->sendMessage("Ally request sent to".$target->getName());
                 $target->sendMessage($sender->getName()." Wants to be allys! please do /accept to accpet thier allyship request!");
                $task = new accept($this, $target);
                array_push($target->getName(), $this->request);
		 $this->getServer()->getScheduler()->scheduleDelayedTask($task, 600);
		 $this->queue[$target->getName()][$sender->getName()];
		 return true;
            }
                }else{
                	$sender->sendMessage("Please do this command in game!");
                	return false;
                }
                }
 }
 if(strtolower($cmd->getName()) === "accept") {
 if(in_array($target->getName(),$this->request)){
 	//not sure why use ->getName() again since it not a player instance
 	$sender->sendMessage("Request from ".$this->queue[$target][$sender]."Accepted!");
 	$target = $this->getServer()->getPlayer($this->queue[$target][$sender]);
 	$target->sendMessage("Player ".$sender->getName()." has accepted your request! :));
 	return true;
 }else{
 	$sender->sendMessage("You have no request!");
 	return false;
 }
}
}
}

            
        
