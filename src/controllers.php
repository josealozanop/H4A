<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
//Request::setTrustedProxies(array('127.0.0.1'));

require_once 'utils.php';
require_once 'db_utils.php';
require_once( __DIR__."/Controllers/BD/DAO_rooms.php");
require_once( __DIR__."/Controllers/BD/DAO_config.php");
require_once( __DIR__."/Controllers/BD/DAO_sensorActuador.php");
require_once( __DIR__."/Controllers/BD/DAO_users.php");
require_once( __DIR__."/Controllers/BD/DAO_devices.php");


/**
	0 => Redirección a la interfaz de usuario
	1 => Redirección a la interfaz de tutor
**/

 setcookie("sessionType", 0);
/*if(!isset($_COOKIE['sessionType'])){
    setcookie("sessionType",1);
}*/

$app->get("/userSelection", function(Request $request) use ($app){
	session_destroy();
	$MAC = getMAC();
	echo $MAC;
	echo "<br><br><br><br><br><br>";
	$dbDevices = new DAO_devices($app["db"]);
	$dbUsers = new DAO_users($app["db"]);
	//Obtenemos el id del dispositivo con dicha mac
	$devicesIds = $dbDevices->getDevices("mac_dispositivo = '$MAC'");
	print_r($devicesIds);
	echo'@@@@@@@@@@@@@@@@@@@@@@@@@@@';
	//Obtenemos los usuarios que tiene acceso a dicho dipositivo
	$usersIds = $dbUsers->getUsersByDevices($devicesIds);
	print_r($usersIds);
	$users = array_map(function($id) use ($dbUsers){
		$newUser = $dbUsers->getUser($id);
		return $newUser->toArray();
	}, $usersIds);
	
	//Elimnamos información confidencial como la password y los apellidos
	//ya que dicha información estará disponible en javascript
	$userSafeData = array();
	foreach($users as $user){
		print_r($user);
		$assetsManager = new userAssets($user["id_usuario"]);
		array_push($userSafeData, array(
			"nombre" => $user["nombre_usuario"],
			"img" => $assetsManager->getUserImg(),
			"id_usuario" => $user["id_usuario"]
		));
	}
	
	$os = PHP_OS;
	if($os == 'Linux'){
		$os = 0;
	}
	else{
		$os = 1;
	}
	
	//establecemos las imagenes de los elementos de de navegacion
	$assetsManager =  new userAssets($users[0]["id_usuario"]);
	$defultItemsImgs = array(
		"back" => $assetsManager->getDefaultAsset("back"),
		"logOut" => $assetsManager->getDefaultAsset("logOut"),
		"user" => $assetsManager->getDefaultAsset("user"),
		"sensors" => $assetsManager->getDefaultAsset("sensors")
	);
	
	/*$defultItemsImgs = array(
		"back" => $assetsManager->getDefaultAsset("back"),
		"logOut" => $assetsManager->getDefaultAsset("logOut"),
		"user" => $assetsManager->getDefaultAsset("user"),
		"sensors" => $assetsManager->getDefaultAsset("sensors")
	);^*/
	
	$data = base64_encode(json_encode(array(
		"mac" => $MAC,
		"users" => $userSafeData,
		"assets" => $defultItemsImgs
	)));
	
	return $app['twig']->render('userSelection.html', array(
		'data' => $data,
		"os" => $os));
})->bind('userSelection');

$app->get("/insertPass", function(Request $request) use ($app){	
	$sid = $request->get('sid');
	$idUser = base64_decode($sid);
	$dbUsers = new DAO_users($app["db"]);
	$user = $dbUsers->getUser($idUser);
	$pass = $user->getPass_usuario();
	
	if($pass != "" and $pass != null){
		
		return $app['twig']->render('insertPass.html', array(
			"nombre" => $user->getNombre_usuario(),
			"idUser" => $user->getId_usuario()
			)
		);
	}
	else{
		session_destroy();
		session_start();
		$_SESSION['sid'] = $idUser;
		return $app->redirect("./homeController");
	}
	
})->bind('insertPass');


$app->get("/homeController", function(Request $request) use ($app){
	//$selectedUser = $request->get('sid');
	//$selectedUser = base64_decode($selectedUser);
	$selectedUser = $_SESSION['sid'];
	$MAC = getMAC();
	
	$dbRooms = new DAO_rooms($app["db"]);
	$dbConfig = new DAO_config($app["db"]);
	$dbSensors = new DAO_sensorActuador($app["db"]);
	$dbUsers = new DAO_users($app["db"]);
	
	$user = $dbUsers->getUser($selectedUser);
	
	$allSensorsIds = $dbSensors->getSensorByUsers(array($selectedUser));
	$allSensors = array_map(function($id) use ($dbSensors){
		$newSensor = $dbSensors->getSensor($id);
		return $newSensor->toArray();
	}, $allSensorsIds);
	

	$allRoomsIds = $dbRooms->getRooms("");
	$roomsWithSensors = array();
	
	foreach($allRoomsIds as $roomId){
		foreach($allSensors as $sensor){
			if($roomId == $sensor["id_habitacion"]){
				array_push($roomsWithSensors, $roomId);
				break;
			}
		}
	}
	
	//Si queremos solo habitaciones con sensores
	/*
	$allRooms = array_map(function($id) use ($dbRooms){
		$newRoom = $dbRooms->getRoom($id);
		return $newRoom->toArray();
	}, $roomsWithSensors);
	*/
	
	//Si queremos todas las habitaciones
	$allRooms = array_map(function($id) use ($dbRooms){
		$newRoom = $dbRooms->getRoom($id);
		return $newRoom->toArray();
	}, $allRoomsIds);
	
	//Establecemos el fichero css que le corresponde al usuario
	$assetsManager = new userAssets($selectedUser);
	//$cssFile = $assetsManager->getCssFile();
	//echo $cssFile;
	
	//Establecemos las imagenes de cada habitación
	foreach($allRooms as &$room){
		$filePath = $assetsManager->itemHasOwnImage("/rooms/", $room["id_habitacion"]);
		if($filePath){
			$room["img"] = $filePath;
		}
		else{
			$room["img"] = $assetsManager->getDefaultAsset("room");
		}	
	}

	
	//Establecemos las imágenes para cada uno de los sensores
	foreach($allSensors as &$sensor){
		$filePath = $assetsManager->itemHasOwnImage("/sensors/", $sensor["id_sen"]);
		//echo $filePath;
		switch($sensor["TipoValor"]){
			case '0':
				$filePathOn = $assetsManager->itemHasOwnImage("/sensors/", $sensor["id_sen"], "ON");
				$filePathOff = $assetsManager->itemHasOwnImage("/sensors/", $sensor["id_sen"], "OFF");
				
				if($filePathOff){
					$sensor["img"] = $filePathOff;
				}
				else{
					$sensor["img"] = $assetsManager->getDefaultAsset("digitalOFF");
				}
				
				if($filePathOn){
					$sensor["imgActive"] = $filePathOn;
				}
				else{
					$sensor["imgActive"] = $assetsManager->getDefaultAsset("digitalON");
				}
			break;
			
			case '1':
				if($filePath){
					$sensor["img"] = $filePath;
				}
				else{
					$sensor["img"] = $assetsManager->getDefaultAsset("digital");
				}
			break;
			
			case '2':
				if($filePath){
					$sensor["img"] = $filePath;
				}
				else{
					$sensor["img"] = $assetsManager->getDefaultAsset("analogic");
				}
			break;
			
			case '-1':
				if($filePath){
					$sensor["img"] = $filePath;
				}
				else{
					$sensor["img"] = $assetsManager->getDefaultAsset("sensors");
				}

			break;
			
			default:
				$sensor["img"] = $assetsManager->getDefaultAsset("digitalOFF");
				$sensor["imgActive"] = $assetsManager->getDefaultAsset("digitalON");
			break;
		}
	}
	
	//establecemos las imagenes de los elementos de de navegacion
	$defultItemsImgs = array(
		"back" => $assetsManager->getDefaultAsset("back"),
		"logOut" => $assetsManager->getDefaultAsset("logOut"),
		"user" => $assetsManager->getDefaultAsset("user"),
		"sensors" => $assetsManager->getDefaultAsset("sensors")
	);
	
	//print_r($allSensorsIds);
	$configData = $dbConfig->getFullConfig($selectedUser, $MAC);
	$config = $configData["config"];
	$layout = $configData["layout"];
	//print_r($config);
	//print_r($layout);
	//echo $MAC;
	
	$dirtyUser = $user->toArray();
	$cleanUser = array();
	$cleanUser["nombre_usuario"] = $dirtyUser["nombre_usuario"];
	$cleanUser["id_usuario"] = $dirtyUser["id_usuario"];

	$data = base64_encode(json_encode(array(
		"rooms" => $allRooms,
		"sensors" => $allSensors,
		"config" => $config->toArray(),
		"layout" => $layout->toArray(),
		"assets" => $defultItemsImgs,
		"user" => $cleanUser
	)));
	
	$os = PHP_OS;
	if($os == 'Linux'){
		$os = 0;
	}
	else{
		$os = 1;
	}
	
	return $app['twig']->render('homeController.html', array(
		'data' => $data,
		'userId' => $selectedUser,
		'cssFile' => $config->getCss(),
		'os' => $os
		)
	);
})->bind('homeController');


$app->get('/', function(Request $request) use ($app) {
	
	//descomentar para ir a la parte de tutor
	return $app['twig']->render('index.html', array(
			'error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));
	
	$subRequest = Request::create('/homeController', 'GET');
    return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
	
	$mac=getMAC();
	$query = "select id_dispositivo from dispositivo where mac_dispositivo='$mac'";
	$data = $app['db']->fetchAll($query);
	$user = $app['security']->getToken()->getUser();
	
	//Si la MAC no está registrada y no estás logueado redirección a la pantalla de inicio
	if($user=="anon." and $data==null){
		return $app['twig']->render('index.html', array(
			'error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));	
	}
	//Si la Mac no está registrada y estás logueado
	else if($data==null){
		return $app['twig']->render('tutor.html', array(
			'error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));
	}
	//Si la MAC registrada
	else if($data){
		//$GLOBALS['tipoInterfaz'] = 0;
		if($_COOKIE['sessionType'] == 0){
			return $app['twig']->render('userLogin.html', array());
		}
		else if($_COOKIE['sessionType'] == 1 and $user!="anon."){
			return $app['twig']->render('tutor.html', array(
				'error' => $app['security.last_error']($request),
				'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));	
		}
		else if($_COOKIE['sessionType'] == 1 and $user=="anon."){
			return $app['twig']->render('index.html', array(
				'error' => $app['security.last_error']($request),
				'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));
		}
	}
	
	/*
	if ( $GLOBALS['s'] == 0){
	return $app['twig']->render('negro.html', array('error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username')));
	}
	else if($GLOBALS['s'] == 1){
		if($user=="anon." and $data==null){
			return $app['twig']->render('index.html', array(
				'error' => $app['security.last_error']($request),
				'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));	
		}
		if($data == null){	
			return $app['twig']->render('tutor.html', array(
				'error' => $app['security.last_error']($request),
				'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));	
		}
		return $app['twig']->render('negro.html', array('error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username')));	
	}*/
		
})
->bind('homepage')
;

$app->get('/userLogin', function(Request $request) use ($app) {
	echo $_COOKIE['sessionType'];
    return $app['twig']->render('userLogin.html', array());
})
->bind('userLogin');

$app->get('/changeType', function(Request $request) use ($app) {
	if($_COOKIE['sessionType'] == 1){
		setcookie("sessionType", 0);
	}
	else{
		setcookie("sessionType", 1);
	}
	return $app['twig']->render('index.html', array(
			'error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username'),'accion'=>""));
})->bind('changeType');

$app->get('/login_check', function(Request $request) use ($app) {
    return $app['twig']->render('index.html', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login_check');

$app->get('/_profiler/wdt/{id}', function(Request $request) use ($app) {

	return $app->redirect($app["url_generator"]->generate("tutor"));
})->bind('wdt');

$app->get('/vacia', function (Request $request) use ($app) {
	$data = $request->get('data');
		
	$data = array(
		"color1" => "blue",
		"color2" => "white",
	);
	$c = new Config();
	$c->fromArray($data);
	//configController::setConfig($app['db'], $c);
	$variable = $c->getColor1();
	
	$formatedObject = $c->toJson();
	
    return $app['twig']->render('vacia.html', array(
	'variable' => $formatedObject,
	'data' => $data
	));
})
->bind('vacia')
;

$app->get('/rawHelp', function (Request $request) use ($app) {

    return $app['twig']->render('rawHelp.html', array(
	));
})->bind('rawHelp');

$app->get('/help', function (Request $request) use ($app) {
    return $app['twig']->render('help.html', array(
		"datos" => "a"
	));
})->bind('help');

$app->get('/updateSys', function (Request $request) use ($app) {
	
    return $app['twig']->render('updateSys.html', array(
		"datos" => $datos
	));
})->bind('updateSys');

$app->get('/getClientMac', function (Request $request) use ($app) {
	$out = array(
		'serverMac' => null,
		'clientMac' => null,
		'clientIp' => $_SERVER['REMOTE_ADDR'],
		'serverIp' => $_SERVER['SERVER_ADDR']
	);
	
	$mac = getMAC();
	
	$out["clientMac"] = $mac;
	
	$out = json_encode($out);
	return new Response($out);
})->bind('getClientMac');

$app->get('/insertConfig', function (Request $request) use ($app) {
	$input = json_decode(base64_decode($request->get("data")), true);
	$configData = $input["config"];
	//print_r($configData);
	$layout = $input["layout"];
	$id_usuario = $input["id"];
	
	$out = array(
		"data" => null,
		"status" => 0,
		"error_msg" => ""
	);
	
	$config = new Config();
	$config->fromArray($configData);
	//print_r($config);
	$db = new DAO_config($app['db']);
	$db->insertConfig($config, $layout, $id_usuario);
	$out["status"] = 1;
	$out["data"] = array(
		"id_usuario" => $id_usuario,
		"config" => $configData,
		"layout" => $layout
	);
	
	$out = json_encode($out, true);
	return new Response($out);
})->bind("insertConfig");


//Ejemplo de servicio asíncrono utilizando get. 
$app->get('/echo', function (Request $request) use ($app) {
	$input = json_decode(base64_decode($request->get("data")), true);
	
	$out = array(
		"data" => null,
		"status" => 0,
		"error_msg" => ""
	);
	
	if($input["action"] == "ping"){
		$out["status"] = -1;
		$out["data"] = "pong";
		
	}
	else{
		$out["status"] = -1;
		$out["error_msg"] = "action not allowed";
		$out["data"] = $input;
	}
	
	$out = json_encode($out, true);
	return new Response($out);
})->bind("echo");

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

/*no toques esto*/
$app->get('/serviceController', function (Request $request) use ($app) {
	$type_service = $request->get('service');
	$out = "Service ".$type_service.' was not found';
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$input = json_decode($request->get('input'));
		
	switch ($type_service) {	
	
		case "echo" :
			$out = $input -> {'MAC'};
			//$out = $input;
		break;
		
		case "error":
			trigger_error("Para provocar errores.");
		break;
			
		/***
		SERVICIOS CONSULTA DE DATOS
		****/
		case 'getMyData':
			$out = json_encode(getMyData($app['db'], $tutor_id));
			break;
		
		//Obtiene todos los datos de todos los usuario de un tutor
		case 'getMyUsers':
			$users_id = get_my_users($app['db'], $tutor_id);
			$users_data =  Array();
			foreach($users_id as $i) { 
				$user_data = get_user_data($app['db'], $i['id_usuario']);
				array_push($users_data,$user_data); 
			}
			$out = json_encode($users_data);
			break;
		
		case 'getAllTutorName':
			$out = json_encode(get_all_tutors_name($app['db'], $tutor_id));
		break;
			
		case "getMAC":
			$out = getMAC();
		break;
			
		case "getMyDevices":
			$out = json_encode(get_my_devices($app['db'], $tutor_id));
		break;
		
		case "getMySensor":
			$out = json_encode(get_my_sensor($app['db']));
		break;
		
		case "getMySensorBedroom":
			$id_hab = $input -> {'id_hab'};
			$out = json_encode(get_my_sensor_bedroom($app['db'],$id_hab));
		break;
		
		case "getAllRooms":
			$out = json_encode(get_all_rooms($app['db']));
		break;
		
		case "getAllSensors":
			$id_user = $input -> {'id_user'};
			$out = json_encode(get_all_sensors($app['db'], $id_user));
		break;
		
		case "getLinkSensors":
			$id_user = $input -> {'id_user'};
			$out = json_encode(get_link_sensors($app['db'], $id_user));
		break;
			
		/***
		SERVICIOS MODIFICACIÓN DE DATOS
		****/	
		case "insertDevice":  
			$device_mac =  $input -> {'MAC'};
			$device_uDefault = $input -> {'uDefault'};
			//$out = $device_mac.$device_uDefault;
			$out = insert_device($app['db'], $device_mac, $device_uDefault);
			
		break;
		
		case "linkDeviceTutor":
			$id_dispositivo = $input -> {'idDispositivo'};
			$nombre_dispositivo = $input -> {'nombreDispositivo'};
			//$out = "hola";
			//$out = $id_dispositivo.$nombre_dispositivo.$tutor_id;
			$out = link_device_tutor($app['db'], $tutor_id, $id_dispositivo, $nombre_dispositivo);
		break;
		
		case "linkDeviceUser":
			$id_dispositivo = $input -> {'idDispositivo'};
			$id_usuario = $input -> {'idUsuario'};
			$out = link_device_user($app['db'],$id_dispositivo,$id_usuario);
		break;
		
		default:
			$out = "Service ".$type_service.' was not found';
			break;
	}
	
    return new Response($out);
})->bind('serviceController');


