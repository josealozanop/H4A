<?php
	require_once __DIR__.'/../../vendor/autoload.php';
	$app = require __DIR__.'/../app.php';
	require_once( __DIR__."'/../Model/room.php");
	$usuario = $app['db'];
	//$conn2 = Doctrine_Manager::connection();
	
	//Decodificamos los datos pasados
	$input = file_get_contents("php://input");
	$input = base64_decode($input);
	$input = json_decode($input, true);

	print(1);

?>