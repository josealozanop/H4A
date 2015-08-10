<?php
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../Controllers/BD/DAO_users.php';
require_once __DIR__.'/../Model/user.php';



class userAssets{
	public static $linuxPath = "/var/www/H4A2/H4A/";
	public static $windowsPath = "C:/wamp/www/H4A/";
	public static $h4aPath = "users/";
		
	protected $conn;
	protected $dbUsers;
	protected $fullPath;
	protected $dirPath;
	protected $os;
	protected $user;
	
	public function __construct($userId = -1){
		if($userId > -1){
			$app = require __DIR__.'/../app.php';
			$this->conn = $app['db'];
			$this->dbUsers = new DAO_users($this->conn);
			$this->user = $this->dbUsers->getUser($userId);
			//print_r($this->user);
			$this->setOs();
			$this->setFullPath();
		}
	}	
	
	public function getFullPath(){
		return $this->fullPath;
	}

	public function setFullPath(){
		if($this->os == "Linux"){
			$this->dirPath = userAssets::$linuxPath.userAssets::$h4aPath;
			$this->fullPath = $this->dirPath.$this->user->getMail_usuario();
		}
		else if($this->os == "Windows"){
			$this->dirPath = userAssets::$windowsPath.userAssets::$h4aPath;
			$this->fullPath = $this->dirPath.$this->user->getMail_usuario();
		}
	}
	
	public function setOs(){
		if(PHP_OS == "Linux"){
			$this->os = "Linux";
		}
		else{
			$this->os = "Windows";
		}
	}
	
	public function hasDir(){
		if(is_dir($this->fullPath)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function createDir(){
		if(!$this->hasDir()){
			mkdir($this->getFullPath(), 0777, true);
		}
	}

}
?>