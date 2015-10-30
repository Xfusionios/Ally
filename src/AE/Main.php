<?php
namespace AE;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\command\ConsoleCommandSender;
class Main extends PluginBase implements Listener{
	public $active = array();
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
	}
	
	
