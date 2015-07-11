<?php
require_once( __DIR__."'/../../Model/sensorActuador.php");
require_once( __DIR__."'/../../Controllers/BD/dbUtils.php");
require_once( __DIR__."'/../../Controllers/BD/TD.php");

class DAO_sensorActuador{
	protected $conn;
		
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
		
	public function getSensor($id){
		$tableName = TD::$sensorActuador["name"];
		$idField = TD::$sensorActuador["id"];
		$sensorAssoc = $this->conn->fetchAssoc("SELECT * FROM $tableName WHERE $idField = ?", array($id));
		$sensor = new sensorActuador();
		$sensor->fromArray($sensorAssoc);
		return $sensor;
	}
	/**
	* Cogemos los sensores vinculados a un usuario.
	* 
	**/
	public function getSensorByUsers($usersIds = array()){
		$sensorTableName = TD::$sensorActuador["name"];
		$sensorIdField = TD::$sensorActuador["id"];
		$linkerTableName = TD::$sensor_usuario["name"];
		
		$sensors = array();
		if(count($usersIds)){
			foreach($usersIds as $id){
				$sql = "SELECT $linkerTableName.id_sensor FROM $linkerTableName  INNER JOIN $sensorTableName ON $sensorTableName.id_sen = $linkerTableName.id_sensor WHERE $linkerTableName.id_usuario = $id";
				//echo($sql);
				$ids = $this->conn->fetchAll($sql);
				$ids = array_map(function($arr){
					return $arr["id_sensor"];
				}, $ids);
				
				if(count($ids)){
					$sensors = array_merge($sensors, $ids);
				}
			}
		}
		
		return $sensors;
	}
		
	public function updateSensor(sensorActuador $sensor){
		if($sensor){
			$sensorTableName = TD::$sensorActuador["name"];
			$sensorIdField = TD::$sensorActuador["id"];
			//print_r($sensor->toArray());
			$this->conn->update($sensorTableName, $sensor->toArray(), array($sensorIdField => $sensor->getId_sen()));
		}
	}	
}
?>