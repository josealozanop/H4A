<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
//Request::setTrustedProxies(array('127.0.0.1'));

require 'utils.php';
require 'db_utils.php';
$s=1;

$app->get('/', function(Request $request) use ($app) {
	$mac=getMAC();
	$query = "select id_dispositivo from dispositivo where mac_dispositivo='$mac'";
	$data = $app['db']->fetchAll($query);
	$user = $app['security']->getToken()->getUser();
	if ( $GLOBALS['s'] == 0){
	return $app['twig']->render('negro.html', array('error' => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username')));}
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
})
->bind('homepage')
;


$app->get('/login_check', function(Request $request) use ($app) {
    return $app['twig']->render('index.html', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})
->bind('login_check')
;

$app->get('/_profiler/wdt/{id}', function(Request $request) use ($app) {

	return $app->redirect($app["url_generator"]->generate("tutor"));
})
->bind('wdt')
;








/*
$app->post('/modDispositivo', function (Request $request) use ($app) {
	$nombre =  $request->get('nombre');
	$defecto =$request->get('usuarioDefec');
	$mac = $request->get('mac');
	$id_dispositivo = $request->get('id_disp');
	$id_dispositivo = str_replace("\t", '', $id_dispositivo);
	$app['db']->update('dispositivo', array(
		'nombre_dispositivo'=>$nombre,'mac_dispositivo'=>$mac,'uDefecto_dispositivo'=>$defecto), array('id_dispositivo'=>$id_dispositivo
	));
	return $app['twig']->render('tutor.html', array('accion' =>"Usuario modificado correctamente"
	));
	/*return $app['twig']->render('verUsuario.html', array('editar' =>"true",
	'usuario' => $usuario
	));
	
})
->bind('modDispositivo')
;

*/



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
})
->bind('rawHelp')
;

$app->get('/help', function (Request $request) use ($app) {
	/*$filePath = "../templates/rawHelp.html";

	$myfile = fopen($filePath , "r") or die("Unable to open file!");
	$datos = fread($myfile,filesize($filePath ));
	fclose($myfile);*/
	$datos = "hoiola";
    return $app['twig']->render('help.html', array(
		"datos" => $datos
	));
})
->bind('help')
;

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
})
->bind('serviceController')
;
