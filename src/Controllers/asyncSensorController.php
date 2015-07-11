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
		case "getSensors":
			$ids = $input["data"];
			$dbSensors = new DAO_sensorActuador($db);
			$values = array();
			foreach($ids as $id){
				$sensor = $dbSensors->getSensor($id);
				array_push($values, $sensor->getValor());			
			}
			$output["status"] = 1;
			$output["data"] = $values;
		break;
		
		case "setSensor":
			$id = $input["id"];
			$value = $input["value"];
			$dbSensors = new DAO_sensorActuador($db);
			$sensor = $dbSensors->getSensor($id);
			$sensor->setValor($value);
			$dbSensors->updateSensor($sensor);
			$output["status"] = 1;
		break;
	}	
	
	print(json_encode($output));

?>