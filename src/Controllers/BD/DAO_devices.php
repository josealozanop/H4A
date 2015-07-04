<?php
require_once( __DIR__."'/../../Model/device.php");
require_once( __DIR__."'/../../Controllers/BD/dbUtils.php");
require_once( __DIR__."'/../../Controllers/BD/TD.php");

class DAO_devices{
	protected $conn;
	
	protected static $maps = array(
		"roomObject" => array(
			"id_dispositivo" => "id_dispositivo",
			"mac_dispositivo" => "mac_dispositivo",
			"uDefecto_dispositivo" => "uDefecto_dispositivo"
		)
	);
	
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	public function getDevice($id){
		$tableName = TD::$dispositivo["name"];
		$idField = TD::$dispositivo["id"];
		$deviceAssoc = $this->conn->fetchAssoc("SELECT * FROM $tableName WHERE $idField = ?", array($id));
		$device = new User();
		$device->fromArray($deviceAssoc);
		return $device;
	}
	
	public function getDevices($filter = ""){
		$tableName = TD::$dispositivo["name"];
		$idField = TD::$dispositivo["id"];
		
		$sql = "select $idField from $tableName";
		if($filter){
			$sql .= " where ".$filter;
		}
		
		$ids = $this->conn->fetchAll($sql);
		$ids = array_map(function($arr) use ($idField){
			return $arr[$idField];
		}, $ids);
		return $ids;
	}
	
}
?>