<?php
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../Controllers/BD/DAO_users.php';
require_once __DIR__.'/../Controllers/BD/DAO_config.php';
require_once __DIR__.'/../Model/user.php';



class userAssets{
	public static $linuxPath = "/var/www/H4A2/";
	public static $windowsPath = "C:/wamp/www/";
	public static $h4aPath = "H4A/users/";
	public static $defultAsset = array(
		"analogic" => "analogic.svg",
		"digital" => "digital.svg",
		"digitalON" => "digitalON.svg",
		"digitalOFF" => "digitalOFF.svg",
		"sensors" => "sensors.svg",
		"room" => "home.svg",
		"user" => "user.svg",
		"back" => "back.svg",
		"logOut" => "logOut.svg",
		"default" => "user.svg"
	);
		
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
	
	public function getDirPath(){
		return $this->dirPath();
	}
	
	public function itemHasOwnImage($base, $id, $append = ""){
		$allowedExtensions = array(
			".svg",
			".png",
			".jpg",
			".jpeg"
		);
		
		foreach($allowedExtensions as $extension){
			$filePath = $this->getFullPath().$base.$id.$append.$extension;
			$paths = array(userAssets::$linuxPath, userAssets::$windowsPath);

			if(is_file($filePath)){
				return str_replace($paths, "/", $filePath);
				//return $filePath;
			}
		}
		
		return false;
	}
	
	public function getCssFile(){
		//print_r($this->user);
		$dbConfig = new DAO_config($this->conn);
		$config = $dbConfig->getConfig($this->user->getId_configuracion_usuario());
		//echo $this->user->getId_usuario();
		//print_r($config);
		return $config->getCss();
	}
	
	public function getDefaultAsset($asset){
		if(userAssets::$defultAsset[$asset]){
			return $this->getDirPath().userAssets::$defultAsset[$asset];
		}
		else{
			return $this->getDirPath().userAssets::$defultAsset["default"];
		}
	}

}
?>