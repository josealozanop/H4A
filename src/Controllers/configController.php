<?php
	require_once __DIR__.'/../../vendor/autoload.php';
	$app = require __DIR__.'/../app.php';
	require_once( __DIR__."'/../Model/config.php");
	require_once("BD/DAO_config.php");

	$usuario = $app['db'];
	//$conn2 = Doctrine_Manager::connection();
	
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
		case "insertConfig":
			$id_usuario = $input["id"];
			$config = new Config();
			$config->fromBase64($input["data"]);
			$devicesLayout = json_decode(base64_decode($input["layoutsData"]), true);
			$db = new DAO_config($usuario);
			$db->insertConfig($config, $devicesLayout, $id_usuario);
			$output["status"] = 1;
			$output["data"] = $input["layoutsData"];
		break;
	}
	
	
	print(json_encode($output));

?>