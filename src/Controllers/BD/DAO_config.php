<?php
require_once( __DIR__."'/../../Model/deviceLayout.php");
require_once( __DIR__."'/../../Model/config.php");
require_once( __DIR__."'/../../Controllers/BD/dbUtils.php");
require_once( __DIR__."'/../../Controllers/BD/TD.php");

class DAO_config{
	protected $conn;
	
	protected static $idField = "id_configuracion_usuario";
	/*protected static $configMap = array(
		"color1" => "color_principal",
		"color2" => "color_secundario",
		"sistemaBarrido" => "barrido",
		"tiempoBarrido" => "tiempo_barrido",
		"contraste" => "contraste",
		"tamLetra" => "tam_letra",
		"respuestaPorVoz" => "retroalimentacion_voz",
		"vibracion" => "retroalimentacion_vibracion",
		"reconocimientoVoz" => "reconocimiento_voz"
	);*/
	protected static $configMap = array(
		"color_principal" => "color_principal",
		"color_secundario" => "color_secundario",
		"barrido" => "barrido",
		"tiempo_barrido" => "tiempo_barrido",
		"contraste" => "contraste",
		"tam_letra" => "tam_letra",
		"retroalimentacion_voz" => "retroalimentacion_voz",
		"retroalimentacion_vibracion" => "retroalimentacion_vibracion",
		"reconocimiento_voz" => "reconocimiento_voz"
	);
	
	
	protected static $layoutMap = array(
		"rotacion" => "rotacion",
		"filas_vertical" => "filas_vertical",
		"columnas_vertical" => "columnas_vertical",
		"filas_horizontal" => "filas_horizontal",
		"columnas_horizontal" => "columnas_horizontal"
	);
	
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	/**
		Inputs:
			$configObject : a configObject
	**/
	public function insertConfig($configObject, $devicesLayout, $id_usuario){
		$userTableName = TD::$usuario["name"];
		$idUserField = TD::$usuario["id"];
		$configTableId = TD::$configuracion_usuario["id"];
		
		//Si el usuario tenía una configuración previa la borramos
		$idOldConfig = $this->conn->fetchArray("SELECT $configTableId FROM $userTableName WHERE $idUserField = ?", array($id_usuario))[0];
		if(intval($idOldConfig) > -1){
			$this->deleteConfig(intval($idOldConfig));
		}
		
		//Insertamos los valores de la configuración que no son del layout
		$configData = dbUtils::mapObject($configObject, self::$configMap);
		$tableName = TD::$configuracion_usuario["name"];
		$this->conn->insert($tableName, $configData);
		
		//Enlazamos la configuración insertada con su usuario
		$id = $this->conn->lastInsertId();
		$this->conn->update($userTableName, array("$configTableId" => $id), array("id_usuario" => $id_usuario));
		
		
		//Insertamos para cada dispositivo del usuario su layout
		$tableName = TD::$dispositivo_usuario["name"];
		foreach($devicesLayout as $layout){
			$newLayout = new deviceLayout();
			$newLayout->fromArray($layout);
			$layoutData = dbUtils::mapObject($newLayout, self::$layoutMap);
			$id_dispositivo = $newLayout->getId_dispositivo();
			$filter = array(
				"id_dispositivo" => $id_dispositivo,
				"id_usuario" => $id_usuario
			);
			$this->conn->update($tableName, $layoutData, $filter);
		}
	}
	
	public function deleteConfig($configId){
		$this->conn->delete(TD::$configuracion_usuario["name"], array("id_configuracion_usuario" => $configId));
	}
	
	public function getConfig($id, $userId=""){
		$configTableName = TD::$configuracion_usuario["name"];
		$layoutTableName = TD::$dispositivo_usuario["name"];
		$idField = TD::$configuracion_usuario["id"];
		
		$configAssoc = $this->conn->fetchAssoc("SELECT * FROM $configTableName WHERE $idField = ?", array($id));
		$config = new Config();
		$config->fromArray($configAssoc);
		
		return $config;
	}
	
	/**
	* \brief Obtiene la configuración completa del usuario
	**/
	public function getFullConfig($userId, $MAC){
		$configTableName = TD::$configuracion_usuario["name"];
		$layoutTableName = TD::$dispositivo_usuario["name"];
		$userTableName = TD::$usuario["name"];
		$idField = TD::$configuracion_usuario["id"];
		$tableUserId = TD::$usuario["id"];
		$tableDeviceName = TD::$dispositivo["name"];
		$tableDeviceMacField = "mac_dispositivo";
		$tableDeviceId = TD::$dispositivo["id"];
		
		//A partir de $userId obtenemos su configuracion
		$id = $this->conn->fetchColumn("SELECT $idField FROM $userTableName WHERE $tableUserId = ?", array($userId), 0);
		$configAssoc = $this->conn->fetchAssoc("SELECT * FROM $configTableName WHERE $idField = ?", array($id));
		$config = new Config();
		$config->fromArray($configAssoc);
		
		//Obtenemos el layout del dispositivo con mac $MAC para el usuario con id $userId
		$deviceId = $this->conn->fetchColumn("SELECT $tableDeviceId FROM $tableDeviceName WHERE $tableDeviceMacField = ?", array($MAC), 0);
		//print "user: $userId, deviceId: $deviceId";
		$devieLayoutAssoc = $this->conn->fetchAssoc("SELECT * FROM $layoutTableName WHERE id_usuario = ? and id_dispositivo = ?", array($userId, $deviceId));
		$deviceLayout = new DeviceLayout();
		$deviceLayout->fromArray($devieLayoutAssoc);
		
		
		$output = array(
			"config" => $config,
			"layout" => $deviceLayout
		);
		return $output;
	}
			
}
?>