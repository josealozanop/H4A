<?php
	require_once __DIR__.'/../../vendor/autoload.php';
	$app = require __DIR__.'/../app.php';
	require_once( __DIR__."'/../Model/sensorActuador.php");
	require_once("BD/DAO_sensorActuador.php");

	$db = $app['db'];
		
	//Decodificamos los datos pasados
	$input = file_get_contents("php://input");
	$input = base64_decode($input);
	$input = json_decode($input, true);
	
	/**
		Estructura de los datos de salida
	**/
	$output = array(
		"status" => 0,
		"error_msg" => "",
		"data" =>"no data set"
	);	
	
	switch($input["action"]){
		
		case "getSensorsByUsers":
			$dbSensors = new DAO_sensorActuador($db);
			$ids = $input["usersIds"];
			$sensorsIds = $dbSensors->getSensorByUsers($ids);
			$sensorsData = array();
			foreach($sensorsIds as $sensorId){
				$newSensor = $dbSensors->getSensor($sensorId);
				array_push($sensorsData, $newSensor->toArray());
			}
			
			$output["data"] = $sensorsData;
			$output["status"] = 1;
		break;
	}	
	
	print(json_encode($output));

?>