<?php
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../Controllers/BD/DAO_users.php';
require_once __DIR__.'/../Controllers/BD/DAO_config.php';
require_once __DIR__.'/../Model/user.php';



class userAssets{
	public static $linuxPath = "/var/www/H4A2/";
	public static $windowsPath = "C:/wamp/www/";
	public static $h4aPath = "H4A/";
	public static $usersPath = "users/";
	public static $defaultImagesPath = "images/svg/";
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
	public static $allowedExtensionsImg = array(
		".svg",
		".png",
		".jpg",
		".jpeg"
	);
	public static $profileImgName = "/profileImg";
		
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
			$this->initPath = userAssets::$linuxPath.userAssets::$h4aPath;
		}
		else if($this->os == "Windows"){
			$this->initPath = userAssets::$windowsPath.userAssets::$h4aPath;
		}
		else{
			$this->initPath = userAssets::$windowsPath.userAssets::$h4aPath;
		}
		$this->dirPath = $this->initPath.userAssets::$usersPath;
		$this->fullPath = $this->dirPath.$this->user->getMail_usuario();
		$this->userImagePath = $this->initPath."web/".userAssets::$defaultImagesPath;
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
		return $this->dirPath;
	}
	
	public function getUserImg(){
		$img = $this->getUserImagePath().userAssets::$defultAsset["user"];
		$allowedExtensions = userAssets::$allowedExtensionsImg;
		
		foreach($allowedExtensions as $extension){
			$posibleImg = $this->getFullPath().userAssets::$profileImgName.$extension;
						
			if(is_file($posibleImg)){
				$img = $posibleImg;
				break;
			}
		}
		if($this->os == "Linux"){
			$img = str_replace("/var/www", "", $img);
		}
		else{
			$img = str_replace("C:/wamp/www", "", $img);
		}
		return $img;
	}
	
	public function getUserImagePath(){
		return $this->userImagePath;
	}
	
	public function itemHasOwnImage($base, $id, $append = ""){
		$allowedExtensions = userAssets::$allowedExtensionsImg;
		
		foreach($allowedExtensions as $extension){
			$filePath = $this->getFullPath().$base.$id.$append.$extension;
			$paths = array(userAssets::$linuxPath, userAssets::$windowsPath);
			$pathsSubs = array("/H4A2/","/");

			if(is_file($filePath)){
				return str_replace($paths, $pathsSubs, $filePath);
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
			$localUrl =  $this->getDirPath().userAssets::$defultAsset[$asset];
		}
		else{
			$localUrl = $this->getDirPath().userAssets::$defultAsset["default"];
		}
		
		return $this->publicUrl($localUrl);
	}
	
	public function publicUrl($base){
		$paths = array($this->getDirPath());
		if($this->os == "Linux"){
			$basePath = "/H4A2/H4A/web/";
		}
		else{
			$basePath = "/H4A/web/";
		}
		
		$publicUrl = str_replace($paths, $basePath."images/svg/", $base);
		return $publicUrl;
	}

}
?>