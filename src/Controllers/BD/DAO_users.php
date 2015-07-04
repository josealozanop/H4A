<?php
require_once( __DIR__."'/../../Model/user.php");
require_once( __DIR__."'/../../Controllers/BD/dbUtils.php");
require_once( __DIR__."'/../../Controllers/BD/TD.php");

class DAO_users{
	protected $conn;
	
	protected static $maps = array(
		"roomObject" => array(
			"id_usuario" => "id_usuario",
			"mail_usuario" => "mail_usuario",
			"pass_usuario" => "pass_usuario",
			"roles" => "roles",
			"nombre_usuario" => "nombre_usuario",
			"apellidos_usuario" => "apellidos_usuario",
			"foto_usuario" => "foto_usuario",											
			"tlfn_usuario" => "tlfn_usuario",												
			"fnac_usuario" => "fnac_usuario",
			"direccion_usuario" => "direccion_usuario",
			"id_configuracion_usuario" => "id_configuracion_usuario"			
		)
	);
	
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	public function getUser($id){
		$tableName = TD::$usuario["name"];
		$idField = TD::$usuario["id"];
		$userAssoc = $this->conn->fetchAssoc("SELECT * FROM $tableName WHERE $idField = ?", array($id));
		$user = new User();
		$user->fromArray($userAssoc);
		return $user;
		
	}
	
	public function getUsers($filter = ""){
		$tableName = TD::$usuario["name"];
		$idField = TD::$usuario["id"];
		
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
	
	public function getUsersByDevices($devicesIds = array()){
		$userTableName = TD::$usuario["name"];
		$userIdField = TD::$usuario["id"];
		$user_deviceTableName = TD::$dispositivo_usuario["name"];
		
		$users = array();
		if(count($devicesIds)){
			foreach($devicesIds as $deviceId){
				$sql = "SELECT $userTableName.$userIdField FROM $userTableName INNER JOIN $user_deviceTableName ON $userTableName.id_usuario = $user_deviceTableName.id_usuario WHERE $user_deviceTableName.id_dispositivo = $deviceId";
				//echo($sql);
				$ids = $this->conn->fetchAll($sql);
				$ids = array_map(function($arr) use ($userIdField){
					return $arr[$userIdField];
				}, $ids);
				//print_r($ids);
				if(count($ids)){
					$users = array_merge($users, $ids);
				}
			}
		}
		
		return $users;
	}
	
}
?>