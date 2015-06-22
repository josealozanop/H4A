<?php
class DAO_config{
	protected $conn;
	protected $configTableName = "configuracion_usuario";
	
	class __construct($dbConn){
		$this->conn = $dbConn;
	}
	
	/**
		Inputs:
			$configObject : a configObject
	**/
	public function setConfig($configObject){
		$confiData = $configObject->toArray();
		$this->conn->insert(configTableName, $configData);
	}
}
?>