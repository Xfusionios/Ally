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
                $this->PlayerFile->set("Ban","false");
                $this->PlayerFile->save();
            }
        }
        
        public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

        
        
