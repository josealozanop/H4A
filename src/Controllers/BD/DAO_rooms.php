<?php
require_once( __DIR__."'/../../Model/room.php");
require_once( __DIR__."'/../../Controllers/BD/dbUtils.php");

class DAO_rooms{
	protected $conn;
	
	protected static $idField = "id_habitacion";		
	protected static $tablesNames = array(
		"habitacion" => "habitacion"
	);
	protected static $maps = array(
		"roomObject" => array(
			"id_habitacion" => "id_habitacion",
			"nombre_habitacion" => "nombre_habitacion",
			"id_vivienda" => "id_vivienda",
			"tipo_habitacion" => "tipo_habitacion",
			"id_sensores" => "id_sensores",
			"id_propietario" => "id_propietario",
			"id_usuarios" => "id_usuarios"												
		)
	);
	
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	public function getRoom($id){
		$tableName = self::$tablesNames["habitacion"];
		$idField = self::$idField;
		$roomAssoc = $this->conn->fetchAssoc("SELECT * FROM $tableName WHERE $idField = ?", array($id));
		$room = new Room();
		$room->fromArray($roomAssoc);
		return $room;
	}
	
	public function getRooms($filter = ""){
		$idField = self::$idField;
		$tableName = self::$tablesNames["habitacion"];
		$sql = "select $idField from $tableName";
		if($filter){
			$sql .= " where ".$filter;
		}
		$ids = $this->conn->fetchAll($sql);
		$ids = array_map(function($arr){
			return $arr[self::$idField];
		}, $ids);
		return $ids;
	}
	
}
?>