<?php
	require_once __DIR__.'/../../vendor/autoload.php';
	$app = require __DIR__.'/../app.php';
	require_once( __DIR__."'/../Model/room.php");
	require_once("BD/DAO_rooms.php");

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
		
		case "getRooms":
			$dbRooms = new DAO_rooms($db);
			$ids = $dbRooms->getRooms();
			$values = array();
			foreach($ids as $id){
				$room = $dbRooms->getRoom($id);
				array_push($values, $room->toArray());			
			}
			/*$id = $input["id"];
			$value = $input["value"];
			$dbSensors = new DAO_sensorActuador($db);
			$sensor = $dbSensors->getSensor($id);
			$sensor->setValor($value);
			$dbSensors->updateSensor($sensor);*/
			$output["data"] = $values;
			$output["status"] = 1;
		break;
		
		default:
			$output["status"] = -1;
			$output["error_msg"] = "no such action";
		break;
	}	
	
	print(json_encode($output));

?>