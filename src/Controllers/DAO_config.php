<?php
class DAO_config{
	protected $conn;
	protected static $configTableName = "configuracion_usuario";
	protected static $parsingMap = array(
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
	
	public function __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	/**
		Inputs:
			$configObject : a configObject
	**/
	public function setConfig($configObject){
		$configData = self::parseConfigObject($configObject);
		$a = self::$configTableName;
		$this->conn->insert($a, $configData);
	}
	
	
	public static function parseConfigObject($configObject){
		$configArray = $configObject->toArray();
		$parsedData = array();
		foreach (self::$parsingMap as $key => $value) {
			if($configArray[$key]){
				$parsedData[$value] = $configArray[$key];
			}
		}
		return $parsedData;
	}
	
}
?>