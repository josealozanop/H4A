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
	
	public function getSensorByUser($filter){
		
	}
	
}
?>