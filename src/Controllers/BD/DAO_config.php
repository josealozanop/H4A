<?php
require_once( __DIR__."'/../../Model/deviceLayout.php");

class DAO_config{
	protected $conn;
	protected static $configTableName = "configuracion_usuario";
	protected static $devicesLayoutTableName = "dispositivo_usuario";
	protected static $configMap = array(
		"color1" => "color_principal",
		"color2" => "color_secundario",
		"sistemaBarrido" => "barrido",
		"tiempoBarrido" => "tiempo_barrido",
		"contraste" => "contraste",
		"tamLetra" => "tam_letra",
		"respuestaPorVoz" => "retroalimentacion_voz",
		"vibracion" => "retroalimentacion_vibracion",
		"reconocimientoVoz" => "reconocimiento_voz"
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
		$userTableName = "usuario";
		
		//Si el usuario tenía una configuración previa la borramos
		$idOldConfig = $this->conn->fetchArray("SELECT id_configuracion_usuario FROM $userTableName WHERE id_usuario = ?", array($id_usuario))[0];
		if(intval($idOldConfig) > -1){
			$this->deleteConfig(intval($idOldConfig));
		}
		
		//Insertamos los valores de la configuración que no son del layout
		$configData = self::parseConfigObject($configObject, self::$configMap);
		$tableName = self::$configTableName;
		$this->conn->insert($tableName, $configData);
		
		//Enlazamos la configuración insertada con su usuario
		$id = $this->conn->lastInsertId();
		$this->conn->update($userTableName, array("id_configuracion_usuario" => $id), array("id_usuario" => $id_usuario));
		
		
		//Insertamos para cada dispositivo del usuario su layout
		$tableName = self::$devicesLayoutTableName;
		foreach($devicesLayout as $layout){
			$newLayout = new deviceLayout();
			$newLayout->fromArray($layout);
			$layoutData = self::parseConfigObject($newLayout, self::$layoutMap);
			$id_dispositivo = $newLayout->getId_dispositivo();
			$filter = array(
				"id_dispositivo" => $id_dispositivo,
				"id_usuario" => $id_usuario
			);
			$this->conn->update($tableName, $layoutData, $filter);
		}
	}
	
	public function deleteConfig($configId){
		$this->conn->delete(self::$configTableName, array("id_configuracion_usuario" => $configId));
	}
	
	
	public static function parseConfigObject($configObject, $map){
		$configArray = $configObject->toArray();
		$parsedData = array();
		foreach ($map as $key => $value) {
			if($configArray[$key] or $configArray[$key]==0){
				$parsedData[$value] = $configArray[$key];
			}
		}
		return $parsedData;
	}
	
}
?>