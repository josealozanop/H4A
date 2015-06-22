<?php

	require_once("../Model/config.php");
	require_once("./DAO_config.php");
	
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;


	
	//$conn2 = Doctrine_Manager::connection();
	
	//Decodificamos los datos pasados
	$input = file_get_contents("php://input");
	$input = base64_decode($input);
	$input = json_decode($input, true);
	
	/*$data = base64_decode($input["data"]);
	$data = json_decode($data, true);*/
	
	
	$output = array(
		"status" => 0,
		"error_msg" => "",
		"data" =>"no data set"
	);
	
	
	
	switch($input["action"]){
		case "saveConfig":
			
			$config = new Config();
			$config->fromBase64($input["data"]);
			//$output["data"] = $config->toBase64();
			$output["status"] = 1;
			$output["data"] = true;
		break;
		
		default:
			$output["status"] = -1;
			$output["error_msg"] = "invalid action";
		break;
	}
	
	
	//$input = json_decode($input, true);
	//$data = $input["data2"];
	//$data = base64_decode($data);
	//$inputData = json_decode(base64_decode($input), true);
	/*$email = $request->a;
	$email = $email;*/
	//print json_encode($inputData);
	print(json_encode($output));
	//print("a");
?>