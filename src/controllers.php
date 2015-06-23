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
require "Model/config.php";

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

$app->post('/linkDevicesUser', function (Request $request) use ($app) { //¡¡
	$dataText = $request->get('send');
	$data = json_decode($dataText);
	$idUsuario = $data -> {'idUsuario'};
	$MACS = $data -> {'macs'};
	$indexDefault = $data -> {'indexDefault'};
	$ids = array();	
	$out="";
	
	foreach($MACS as $mac){
		$query = "select id_dispositivo from dispositivo where mac_dispositivo='$mac'";
		$queryData = $app['db'] -> fetchAll($query);
		$id_arr = $queryData[0];
		$id = $id_arr['id_dispositivo'];
		array_push($ids, $id);
		$out = $out.link_device_user($app['db'],$id,$idUsuario);
	}
	
	if(count($ids)!=count($MACS)) {
		trigger_error("Error en linkDeviceUser no se están cogiendo todos los ids");
	}
	
	/*$out="Se pasa a la siguiente pagina con los usuarios ya linkados y con los datos idUsuario = $idUsuario primera MAC $MACS[0] primer id_dispositivo : $ids[0] y json: $dataText";*/
	
	if($indexDefault>-1) {
		link_defualtUser_device($app['db'],$ids[$indexDefault],$idUsuario);
		$out = $out."<br> el dispositivo con id $ids[$indexDefault] tendrá como user por defecto el que tiene como id $idUsuario";
	}
	//$app['security']->getToken()->getUser()->setAttribute('idUser',$idUsuario);
	
	return $app['twig']->render('enableSensors.html', array('idUsuario' =>$idUsuario
	));
})
->bind('linkDevicesUser')
;


$app->post('/modLinkDevicesUser', function (Request $request) use ($app) { //¡¡
	$idUsuario = $request->get('id_usuario');
	
	return $app['twig']->render('mod_enableSensors.html', array('idUsuario' =>$idUsuario
	));
})
->bind('modLinkDevicesUser')
;


$app->post('/modEnableSensors', function (Request $request) use ($app) { //¡¡
	$idUsuario = $request->get('id_usuario');
	
	$idUsuario = $request->get('id_usuario');
	$dataText = $request->get('send');
	$data = json_decode($dataText, true);
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$idUsuario = $data['user_id'];
	$enabledSensors = $data['enabledSensors'];
	$disabledSensors = $data['disabledSensors'];
	$ids = array();
	$app['db']->delete('sensor_usuario', array('id_usuario'=> $idUsuario));	
	
	foreach($enabledSensors as $sensor){
		array_push($ids, $sensor["id_sen"]);
	}
	link_user_sensors($app['db'], $idUsuario, $ids);
	
	
	return $app['twig']->render('tutor.html', array('accion' =>"permisos modificados correctamente"
	));
})
->bind('modEnableSensors')
;

$app->post('/enableSensors', function (Request $request) use ($app) { //¡¡
	$dataText = $request->get('send');
	$data = json_decode($dataText, true);
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$idUsuario = $data['user_id'];
	$enabledSensors = $data['enabledSensors'];
	$ids = array();
	foreach($enabledSensors as $sensor){
		array_push($ids, $sensor["id_sen"]);
	}
	$nEnabledSensors = count($enabledSensors);
	/*
	$out = "El id del usurio al que se le van a habilitar los sensores es: $idUsuario<br>";
	$out .=  "y se le habilitarian  $nEnabledSensors sensores con los siguientes ids: <br>";
	
	
	foreach($enabledSensors as $sensor){
		$id = $sensor['id_sensor'];
		$out .= "$id<br>";
	}*/
	////////////////////////////////////////////////////////////////descomentar la linea de abajo!!!!!!!!!!!!!!!!!!
	//link_user_sensors($app['db'], $idUsuario, $ids);

	$ids_devices = get_user_devices($app['db'], $idUsuario);
	$devicesData = get_devices_data($app['db'], $ids_devices);
	$names = array();
	foreach($ids_devices as $id){
		$newName = get_device_name($app['db'],$id, $tutor_id);
		array_push($names, $newName);
	}
	
	return $app['twig']->render('configUser.html', array('idUsuario' =>$idUsuario, "devicesData" => json_encode($devicesData), "names" =>  base64_encode ( json_encode($names))
	));
	//return new Response($out);
})
->bind('enableSensors');

$app->post('/saveConfig', function (Request $request) use ($app){
	$data = $request->get('send');
	$userConfig = new Config();
	$userConfig->fromBase64($data);
	return $app['twig']->render('tutor.html', array('accion' => $userConfig->toJson()));
	//return new Response($userConfig);
})->bind('saveConfig');



$app->post('/newHabitacion', function (Request $request) use ($app) { //¡¡
	$nombre_hab = $request->get('nombre_hab');
	$propietario_hab = $request->get('propietario_hab');
	$tipo_hab = $request->get('tipo_hab');
	
	$sql = "select id_habitacion FROM habitacion WHERE nombre_habitacion = '$nombre_hab'";
	$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
	if($nombreRep!=null){
		$user = $app['security']->getToken()->getUser();
		$username= $user->getUsername();
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
		$usuarios = $app['db']->fetchAll($sql);	
		return $app['twig']->render('new_habitacion.html', array('usuarios' => $usuarios, 'error' => "El nombre la la habitacion ya existe"
		));
	}
	
	$dataText = $request->get('send');
	$data = json_decode($dataText);
	$idSensorVin = $data -> {'idSensorDes'};
	$ids = array();	
	$out="";
	
	$app['db']->insert('habitacion', array('nombre_habitacion' => $nombre_hab,'tipo_habitacion' => $tipo_hab, 'id_propietario' =>$propietario_hab));
		$sql = "select id_habitacion FROM habitacion WHERE nombre_habitacion = '$nombre_hab'";
		$id_habitacion = $app['db']->fetchColumn($sql, array(), 0);
	foreach($idSensorVin as $id){
		$app['db']->update('sensoractuado', array(
		'id_habitacion'=>$id_habitacion), array('id_sen'=>$id
	));
	}
	return $app['twig']->render('tutor.html', array('accion' =>"habitacion creada correctamente $id "
	));
})
->bind('newHabitacion')
;

$app->post('/newSensor', function (Request $request) use ($app) { 
	$nombreSensor = $request->get('nombreSensor');
	$codigoSensor = $request->get('codigoSensor');
	$modeloSensor = $request->get('modeloSensor');
	$descripSensor = $request->get('descripSensor');
	$senActSensor = $request->get('senAct');
	$tipoSensor = $request->get('tipoSensor');
	$tipoValorSensor = $request->get('tipoValorSensor');
	$pinSensor = $request->get('pinSensor');
	$habitacionSensor = $request->get('habitacionSensor');
	$senAct01=1;
	if($senActSensor=="Sensor")$senAct01=0;
	$sql = "select id_sen FROM sensoractuador WHERE nombre_sensor = '$nombreSensor'";
	$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
	if($nombreRep!=null){
		$sql = "SELECT * FROM habitacion";
		$habitacion = $app['db']->fetchAll($sql);	
		return $app['twig']->render('new_sensor.html', array('habitaciones' => $habitacion, 'error' => "El nombre del $tipoSensor ya existe, introduzca un nombre diferente"));
	}
	$sql = "select id_sen FROM sensoractuador WHERE codigo_sensor = '$codigoSensor'";
	$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
	if($nombreRep!=null){
		$sql = "SELECT * FROM habitacion";
		$habitacion = $app['db']->fetchAll($sql);	
		return $app['twig']->render('new_sensor.html', array('habitaciones' => $habitacion, 'error' => "El codigo del $tipoSensor ya existe, introduzca un codigo diferente"));
	}
	if($habitacionSensor=="")$habitacionSensor=NULL;
	$app['db']->insert('sensoractuador', array('PIN' => $pinSensor,'TipoValor' => $tipoValorSensor,'Tipo' => $senActSensor, 'Valor' =>'0',
		'id_habitacion' =>$habitacionSensor,'codigo_sensor' =>$codigoSensor,'nombre_sensor' =>$nombreSensor,'senact_sensor' => $senAct01,
		'tipo_sensor' => $tipoSensor,'modelo_sensor' =>$modeloSensor,'descripcion_sensor' =>$descripSensor));
	$sql = "select id_sen FROM sensoractuador WHERE nombre_sensor = '$nombreSensor'";
	$id = $app['db']->fetchColumn($sql, array(), 0);
	$app['db']->update('sensoractuador', array(
		'Id_Sensor'=>$id), array('id_sen'=>$id
	));
	return $app['twig']->render('tutor.html', array('accion' =>"$tipoSensor añadido correctamente"
	));
})
->bind('newSensor')
;


$app->post('/modSensor', function (Request $request) use ($app) { 
	$nombreSensor = $request->get('nombreSensor');
	$codigoSensor = $request->get('codigoSensor');
	$modeloSensor = $request->get('modeloSensor');
	$descripSensor = $request->get('descripSensor');
	$senActSensor = $request->get('senAct');
	$tipoSensor = $request->get('tipoSensor');
	$tipoValorSensor = $request->get('tipoValorSensor');
	$pinSensor = $request->get('pinSensor');
	$habitacionSensor = $request->get('habitacionSensor');
	$OldNombre = $request->get('nombreOld');

	$OldCodigo = $request->get('codigoOld');

	$senAct01=1;
	$id=$request->get('id_sensor');
	if($senActSensor=="Sensor")$senAct01=0;
	if($nombreSensor!=$OldNombre){
		$sql = "select id_sen FROM sensoractuador WHERE nombre_sensor = '$nombreSensor'";
		$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
		if($nombreRep!=null){
			$editar="false";
			$sql = "select * FROM sensoractuador S INNER JOIN habitacion H on S.id_habitacion=H.id_habitacion WHERE id_sen = '$id'";
			$sensor = $app['db']->fetchAll($sql);
			if($sensor==null){
				$sql = "select * FROM sensoractuador WHERE id_sen = '$id'";
				$sensor = $app['db']->fetchAll($sql);
			}		
			$sql = "SELECT * FROM habitacion";
			$habitacion = $app['db']->fetchAll($sql);	
			return $app['twig']->render('verSensor.html', array('editar' =>$editar,
			'sensor' => $sensor,'habitaciones' => $habitacion,'error' =>"El nombre del $senActSensor ya existe"));
		}
	}
	if($codigoSensor!=$OldCodigo){
		$sql = "select id_sen FROM sensoractuador WHERE codigo_sensor = '$codigoSensor'";
		$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
		if($nombreRep!=null){
			$editar="false";
			$sql = "select * FROM sensoractuador S INNER JOIN habitacion H on S.id_habitacion=H.id_habitacion WHERE id_sen = '$id'";
			$sensor = $app['db']->fetchAll($sql);
			if($sensor==null){
				$sql = "select * FROM sensoractuador WHERE id_sen = '$id'";
				$sensor = $app['db']->fetchAll($sql);
			}		
			$sql = "SELECT * FROM habitacion";
			$habitacion = $app['db']->fetchAll($sql);	
			return $app['twig']->render('verSensor.html', array('editar' =>$editar,
			'sensor' => $sensor,'habitaciones' => $habitacion,'error' =>"El código del $senActSensor ya existe"));
		}
	}
	if($habitacionSensor=="")$habitacionSensor=NULL;
	$app['db']->update('sensoractuador', array('PIN' => $pinSensor,'TipoValor' => $tipoValorSensor,'Tipo' => $senActSensor, 'Valor' =>'0',
		'id_habitacion' =>$habitacionSensor,'codigo_sensor' =>$codigoSensor,'nombre_sensor' =>$nombreSensor,'senact_sensor' => $senAct01,
		'tipo_sensor' => $tipoSensor,'modelo_sensor' =>$modeloSensor,'descripcion_sensor' =>$descripSensor,'Id_Sensor'=>$id), array('id_sen'=>$id
	));
	return $app['twig']->render('tutor.html', array('accion' =>"$senActSensor modificado correctamente"
	));
})
->bind('modSensor')
;



$app->post('/modHabitacion', function (Request $request) use ($app) { 
	$nombre_hab = $request->get('nombre_hab');
	$nombre_habAnt = $request->get('nombre_habAnt');
	$propietario_hab = $request->get('propietario_hab');
	$tipo_hab = $request->get('tipo_hab');
	$id_habitacion = $request->get('id_hab');
	if($nombre_hab!=$nombre_habAnt){
		$sql = "select id_habitacion FROM habitacion WHERE nombre_habitacion = '$nombre_hab'";
		$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
		if($nombreRep!=null){
			$editar="false";
			$user = $app['security']->getToken()->getUser();
			$username= $user->getUsername();
			$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
			$usuarios = $app['db']->fetchAll($sql);	
			return $app['twig']->render('verHabitacion.html', array('usuarios' => $usuarios, 'error' => "El nombre la la habitacion ya existe", 'editar' => $editar
			));
		}
	}
	$dataText = $request->get('send');
	$data = json_decode($dataText);
	$idSensorVin = $data -> {'idSensorVin'};
	$idSensorDes = $data -> {'idSensorDes'};
	$ids = array();	
	$out="";
	if($propietario_hab=="sameuser"){
		$app['db']->update('habitacion', array('nombre_habitacion' => $nombre_hab,'tipo_habitacion' => $tipo_hab),
		array('id_habitacion'=>$id_habitacion
		));
	}
	else{
		$app['db']->update('habitacion', array('nombre_habitacion' => $nombre_hab,'tipo_habitacion' => $tipo_hab, 'id_propietario' =>$propietario_hab),
		array('id_habitacion'=>$id_habitacion
		));
	}
	
	//$app['db']->insert('habitacion', array('nombre_habitacion' => $nombre_hab,'tipo_habitacion' => $tipo_hab, 'id_propietario' =>$propietario_hab));
	//$sql = "select id_habitacion FROM habitacion WHERE nombre_habitacion = '$nombre_hab'";
	//$id_habitacion = $app['db']->fetchColumn($sql, array(), 0);
	
	foreach($idSensorDes as $id){
		$app['db']->update('sensoractuador', array(
		'id_habitacion'=>NULL), array('id_sen'=>$id
	));
	}
	foreach($idSensorVin as $id){
		$app['db']->update('sensoractuador', array(
		'id_habitacion'=>$id_habitacion), array('id_sen'=>$id
	));
	}
	return $app['twig']->render('tutor.html', array('accion' =>"habitacion creada correctamente"
	));
})
->bind('modHabitacion')
;

$app->post('/OpDisp', function (Request $request) use ($app) {
$id_dispositivo = $request->get('idDisp');
$nombre_dispositivo = $request->get('nomDisp');
$mac_dispositivo = $request->get('macDisp');
$uDefecto_dispositivo = $request->get('uDefDisp');

switch($_POST["enviar"]) { 
    case 1:
		$mac=getMAC();
		$editar="true";      
		$sql = "SELECT mail_usuario FROM usuario where id_usuario='$uDefecto_dispositivo'";
		$uDef = $app['db']->fetchAll($sql);
		$sql = "SELECT * FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo'";
		$usuarios = $app['db']->fetchAll($sql);
		return $app['twig']->render('verDispositivo.html', array('uDef' => $uDef,'usuarios' => $usuarios,'editar' =>$editar,'mac' => $mac,
		'id_dispositivo' => $id_dispositivo,'uDefecto_dispositivo'=>$uDefecto_dispositivo,'nombre_dispositivo' => $nombre_dispositivo,'mac_dispositivo' => $mac_dispositivo,'error'=>""));
        break; 
    case 2: 
		$user = $app['security']->getToken()->getUser();
		$mac=getMAC();
		$editar="false";
		$username= $user->getUsername();
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
		$usuarios = $app['db']->fetchAll($sql);
		$sql = "SELECT * FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo'";
		$dispAsociados = $app['db']->fetchAll($sql);
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username' AND U.id_usuario NOT IN(SELECT u.id_usuario FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo')";
		$dispNoAsociados = $app['db']->fetchAll($sql);	
		
        $sql = "SELECT * FROM usuario where id_usuario='$uDefecto_dispositivo'";
		$uDef = $app['db']->fetchAll($sql);
		return $app['twig']->render('verDispositivo.html', array('uDef' => $uDef,'usuarios' => $usuarios,'editar' =>$editar,'mac' => $mac,
		'id_dispositivo' => $id_dispositivo,'nombre_dispositivo' => $nombre_dispositivo,'mac_dispositivo' => $mac_dispositivo,'uDefecto_dispositivo'=>$uDefecto_dispositivo,'error'=>"",'dispAsociados' => $dispAsociados,'dispNoAsociados'=>$dispNoAsociados ));
        break; 
    case 3: 
		$app['db']->delete('dispositivo', array('id_dispositivo' => $id_dispositivo));	
		return $app->redirect($app["url_generator"]->generate("verDisp"));
        break; 
	} 	
})
->bind('OpDisp')
;

$app->post('/opHabitaciones', function (Request $request) use ($app) {
$id_habitacion = $request->get('idHabitacion');
$propietario = $request->get('propietario');
$user = $app['security']->getToken()->getUser();
$username= $user->getUsername();
switch($_POST["enviar"]) { 
    case 1:
		$editar="true";
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
		$usuarios = $app['db']->fetchAll($sql);	
		if ($propietario == "conProp"){
			$sql = "select id_habitacion,nombre_habitacion,tipo_habitacion,mail_usuario FROM habitacion H INNER JOIN usuario U ON U.id_usuario = H.id_propietario WHERE id_habitacion = '$id_habitacion'";
			$habitacion = $app['db']->fetchAll($sql);
			}
		else{
			$sql = "select * FROM habitacion WHERE id_habitacion = '$id_habitacion'";
			$habitacion = $app['db']->fetchAll($sql);
		}		
		
		return $app['twig']->render('verHabitacion.html', array('editar' =>$editar,
		'habitacion' => $habitacion,'usuarios' => $usuarios,'error' =>"",'propietario' => $propietario
		));
        break; 
    case 2: 
		$editar="false";
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
		$usuarios = $app['db']->fetchAll($sql);	
       if ($propietario == "conProp"){
			$sql = "select id_habitacion,nombre_habitacion,tipo_habitacion,mail_usuario FROM habitacion H INNER JOIN usuario U ON U.id_usuario = H.id_propietario WHERE id_habitacion = '$id_habitacion'";
			$habitacion = $app['db']->fetchAll($sql);
			}
		else{
			$sql = "select * FROM habitacion WHERE id_habitacion = '$id_habitacion'";
			$habitacion = $app['db']->fetchAll($sql);
		}		
		
		return $app['twig']->render('verHabitacion.html', array('editar' =>$editar,
		'habitacion' => $habitacion,'usuarios' => $usuarios,'error' =>"",'propietario' => $propietario
		));
		break; 
    case 3: 
		$app['db']->delete('habitacion', array('id_habitacion' => $id_habitacion));	
		return $app->redirect($app["url_generator"]->generate("verHabitaciones"));
        break; 
	} 	
})
->bind('opHabitaciones')
;


$app->post('/opSensores', function (Request $request) use ($app) {
$id_sensor = $request->get('idSensor');
switch($_POST["enviar"]) { 
    case 1:
		$editar="true";
        $sql = "select * FROM sensoractuador S INNER JOIN habitacion H on S.id_habitacion=H.id_habitacion WHERE id_sen = '$id_sensor'";
		$sensor = $app['db']->fetchAll($sql);
		if($sensor==null){
			$sql = "select * FROM sensoractuador WHERE id_sen = '$id_sensor'";
			$sensor = $app['db']->fetchAll($sql);
		}		
		$sql = "SELECT * FROM habitacion";
		$habitacion = $app['db']->fetchAll($sql);	
		return $app['twig']->render('verSensor.html', array('editar' =>$editar,
		'sensor' => $sensor,'habitaciones' => $habitacion,'error' =>""
		));
        break; 
    case 2: 
		$editar="false";
		$sql = "select * FROM sensoractuador S INNER JOIN habitacion H on S.id_habitacion=H.id_habitacion WHERE id_sen = '$id_sensor'";
		$sensor = $app['db']->fetchAll($sql);
		if($sensor==null){
			$sql = "select * FROM sensoractuador WHERE id_sen = '$id_sensor'";
			$sensor = $app['db']->fetchAll($sql);
		}		
		$sql = "SELECT * FROM habitacion";
		$habitacion = $app['db']->fetchAll($sql);	
		return $app['twig']->render('verSensor.html', array('editar' =>$editar,
		'sensor' => $sensor,'habitaciones' => $habitacion,'error' =>""
		));
        break; 
    case 3: 
		$app['db']->delete('sensoractuador', array('id_sen' => $id_sensor));			
		return $app->redirect($app["url_generator"]->generate("verSensor"));
        break; 
	} 	
})
->bind('opSensores')
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

//crear nuevo tutor
$app->get('/newTutor', function(Request $request) use ($app) {
	$mail = $request->get("inicio_newTutor_mail");
	$name = $request->get("inicio_newTutor_name");
	$last_username = $mail;
	$error = false;
    return $app['twig']->render('new_tutor.html', array(
		'mail' => $mail,
		'name' => $name,
		'last_username' => $last_username,
		'error' => $error
	));
	
})
->bind('newTutor')
;

$app->get('/adminCasa', function(Request $request) use ($app) {
	$casa = $app['db']->fetchAll('SELECT * FROM vivienda');
    return $app['twig']->render('admin_casa.html', array(
	'casa' => $casa
	));
	
})
->bind('adminCasa')
;




$app->post('/modCasa', function (Request $request) use ($app) {
	$localidad = $request->get('localidad_vivienda');
	$provincia = $request->get('provincia_vivienda');
	$cp =  $request->get('cp_vivienda');
	$direccion =$request->get('direccion_vivienda');
$id =$request->get('id_vivienda');
	$app['db']->update('vivienda', array(
		'direccion_vivienda'=>$direccion,'localidad_vivienda'=>$localidad,'provincia_vivienda'=>$provincia,'cp_vivienda'=>$cp), array('id_vivienda'=>$id
	));
	return $app['twig']->render('tutor.html', array('accion' =>"la vivienda se ha modificado correctamente"
	));
	
	
})
->bind('modCasa')
;




//editar un tutor
$app->get('/editTutor', function (Request $request) use ($app) {
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$query = 'SELECT * FROM tutor WHERE id_tutor = "'.$tutor_id.'"';
	$data = $app['db']->fetchAll($query);
    return $app['twig']->render('mod_tutor.html', array( 'error'=>"",'user' => $data, 'editar'=>false));
	
})
->bind('editTutor')
;

$app->get('/verTutor', function (Request $request) use ($app) {
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$query = 'SELECT * FROM tutor WHERE id_tutor = "'.$tutor_id.'"';
	$data = $app['db']->fetchAll($query);
    return $app['twig']->render('mod_tutor.html', array( 'error'=>"",'user' => $data, 'editar'=>true));
	
})
->bind('verTutor')
;

//Modificar el tutor editado previamente
$app->post('/modTutor', function (Request $request) use ($app) {
	
	$tutor_id = $app['security']->getToken()->getUser()->getId();
	$mail = $request->get('Tutor_mail');
	$nombre =  $request->get('Tutor_name');
	$apellidos =$request->get('Tutor_surname');
	$pass =$request->get('Tutor_pass');	
	$encoder = new MessageDigestPasswordEncoder();
	$pass = $encoder->encodePassword($pass, '');
	$tlfn =$request->get('Tutor_phone');

	$query = "SELECT * FROM tutor WHERE mail_tutor = '$mail'";
	$data = $app['db']->fetchAll($query);
	if($data != null){	
		$query = 'SELECT * FROM tutor WHERE id_tutor = "'.$tutor_id.'"';
		$data = $app['db']->fetchAll($query);
		return $app['twig']->render('mod_tutor.html', array( 'error'=>"El correo ya existe pra otro usuario",'user' => $data, 'editar'=>false));
	}	
	
	
	
	$app['db']->update('tutor', array(
		'nombre_tutor'=>$nombre, 'apellidos_tutor'=>$apellidos,'tlfn_tutor'=>$tlfn,'mail_tutor'=>$mail,'pass_tutor'=>$pass), array('id_tutor'=>$tutor_id
	));
	
	//$query = 'SELECT * FROM tutor WHERE id_tutor = "'.$tutor_id.'"';
	//$data = $app['db']->fetchAll($query);
	return $app['twig']->render('tutor.html', array('accion' =>"El tutor ha sido modificado correctamente"));
	
})
->bind('modTutor')
;

$app->get('/get/tutors', function () use ($app) {
	$tutores = $app['db']->fetchAll('SELECT mail_tutor FROM tutor');
	$usuarios = $app['db']->fetchAll('SELECT mail_usuario FROM usuario');
	$text = '['.json_encode($usuarios).','.json_encode($tutores).']'; 
	return new Response($text);
})
;

$app->get('/verDisp', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
	//$variable="hola";
	$username= $user->getUsername();
	$sql = "SELECT * FROM dispositivo D INNER JOIN tutor_dispositivo R ON D.id_dispositivo = R.id_dispositivo INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
    $dispositivos = $app['db']->fetchAll($sql);
	
    return $app['twig']->render('ver_disp.html', array(
	'dispositivos' => $dispositivos
	));
})
->bind('verDisp')
;



$app->get('/verHabitaciones', function (Request $request) use ($app) {
	$sql = "SELECT id_habitacion,nombre_habitacion,tipo_habitacion,nombre_usuario FROM habitacion H INNER JOIN usuario U ON U.id_usuario = H.id_propietario";
    $habitaciones = $app['db']->fetchAll($sql);
	$sql = "SELECT id_habitacion,nombre_habitacion,tipo_habitacion FROM habitacion H where H.id_propietario = 0";
    $habitacionesSinU = $app['db']->fetchAll($sql);
	
    return $app['twig']->render('verHabitaciones.html', array(
	'habitaciones' => $habitaciones,'habitacionesSinU' => $habitacionesSinU
	));
})
->bind('verHabitaciones')
;

$app->get('/nuevaHabitacion', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
	$username= $user->getUsername();
	$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
    $usuarios = $app['db']->fetchAll($sql);	
    return $app['twig']->render('new_habitacion.html', array('usuarios' => $usuarios, 'error' => ""
	));
})
->bind('nuevaHabitacion')
;

$app->get('/nuevoSensor', function (Request $request) use ($app) {
	$sql = "SELECT * FROM habitacion";
    $habitacion = $app['db']->fetchAll($sql);	
    return $app['twig']->render('new_sensor.html', array('habitaciones' => $habitacion, 'error' => ""
	));
})
->bind('nuevoSensor')
;



$app->get('/verdisc', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
	//$variable="hola";
	$username= $user->getUsername();
	$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
    $discapacitados = $app['db']->fetchAll($sql);
	
    return $app['twig']->render('verdisc.html', array(
	'discapacitados' => $discapacitados
	));
})
->bind('verdisc')
;

$app->get('/verUsuario', function (Request $request) use ($app) {
	$id_Usuario = $request->get('id_Usuario');
})
->bind('verUsuario')
;

$app->get('/newDevice', function (Request $request) use ($app) {
	$mac = getMAC();
		$user = $app['security']->getToken()->getUser();
	//$variable="hola";
	$username= $user->getUsername();
	$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
    $usuarios = $app['db']->fetchAll($sql);
	return $app['twig']->render('new_device.html', array('usuarios' => $usuarios, 'mac' => $mac, 'error'=>""));
	
})
->bind('newDevice')
;

$app->post('/modDispositivo', function (Request $request) use ($app) {
	$nombre = $request->get('nombreDispositivo');
	$id_usuario =$request->get('usuarioDefecto');	
	$id_dispositivo =$request->get('id_dispositivo');	
	$numero=$request->get('numero');
    $count = count($numero);	
	$user = $app['security']->getToken()->getUser();
	$nombre_dispositivo = $request->get('nombre_dispOld');
  	$id_tutor= $user->getId();
	//compruebo si el tutor ya tiene ese nombre para un sipositivo
	if($nombre!=$nombre_dispositivo){
		$sql = "select id_dispositivo FROM tutor_dispositivo WHERE nombre_dispositivo = '$nombre' AND id_tutor = '$id_tutor'";
		$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
		if($nombreRep!=null){
			$mac_dispositivo = $request->get('MAC');			
			$uDefecto_dispositivo =$request->get('uDefecto_dispOld');	
			$mac=getMAC();
			$editar="false";
			$username= $user->getUsername();
			$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
			$usuarios = $app['db']->fetchAll($sql);
			$sql = "SELECT * FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo'";
			$dispAsociados = $app['db']->fetchAll($sql);
			$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username' AND U.id_usuario NOT IN(SELECT u.id_usuario FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo')";
			$dispNoAsociados = $app['db']->fetchAll($sql);	
			$sql = "SELECT * FROM usuario where id_usuario='$uDefecto_dispositivo'";
			$uDef = $app['db']->fetchAll($sql);
			return $app['twig']->render('verDispositivo.html', array('uDef' => $uDef,'usuarios' => $usuarios,'editar' =>$editar,'mac' => $mac,
			'id_dispositivo' => $id_dispositivo,'nombre_dispositivo' => $nombre_dispositivo,'uDefecto_dispositivo'=>$uDefecto_dispositivo,'mac_dispositivo' => $mac_dispositivo,'error'=>"El nombre ya esta usado por otro dispositivo",'dispAsociados' => $dispAsociados,'dispNoAsociados'=>$dispNoAsociados ));
		}
	}
	$app['db']->update('dispositivo', array(
		'uDefecto_dispositivo'=>$id_usuario), array('id_dispositivo'=>$id_dispositivo
	));
	$app['db']->update('tutor_dispositivo', array(
		'nombre_dispositivo'=>$nombre), array('id_dispositivo'=>$id_dispositivo, 'id_tutor'=>$id_tutor 
	));
	$app['db']->delete('dispositivo_usuario', array(
    'id_dispositivo' => $id_dispositivo));
	for ($i = 0; $i < $count; $i++) {//introduzco las relaciones con los usuarios
		$app['db']->insert('dispositivo_usuario', array('id_dispositivo' => $id_dispositivo, 'id_usuario' => $numero[$i]));	
	}
	//introduzo la relacion con el tutor
	return $app['twig']->render('tutor.html', array('accion' => "El dispositivo ha sido insertado correctaente"));
})
->bind('modDispositivo')
;

$app->post('/newDispositivo', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
	$id_tutor= $user->getId();
	$mac = $request->get('MAC');
	$nombre = $request->get('nombreDispositivo');
	$id_usuario =$request->get('usuarioDefecto');	
	$numero=$request->get('numero');
    $count = count($numero);	
	//compruebo si el tutor ya tiene ese nombre para un sipositivo
	$sql = "select id_dispositivo FROM tutor_dispositivo WHERE nombre_dispositivo = '$nombre' AND id_tutor = '$id_tutor'";
	$nombreRep = $app['db']->fetchColumn($sql, array(), 0);
	if($nombreRep!=null){
		$username= $user->getUsername();
		$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
		$usuarios = $app['db']->fetchAll($sql);
		return $app['twig']->render('new_device.html', array('usuarios' => $usuarios, 'mac' => $mac,'error' => "Ya existe un dispositivo con ese nombre"));
	}
	//compruebo si el dispositivo ya existe
	$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
	$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	if($id_dispositivo==null){//si el duspositivo no existe lo creo
		$app['db']->insert('dispositivo', array('mac_dispositivo' => $mac,'uDefecto_dispositivo' => $id_usuario));
		$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
		$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	}
	else{//si el dispositivo existe compruebo si el dispositivo ya existe para ese tutor concreto y si es asi me salgo
		$sql = "select id_dispositivo FROM tutor_dispositivo WHERE id_tutor = '$id_tutor' AND id_dispositivo= '$id_dispositivo'";
		$comp = $app['db']->fetchColumn($sql, array(), 0);
		if($comp!=null){
			$username= $user->getUsername();
			$sql = "SELECT * FROM usuario U INNER JOIN tutor_usuario R ON U.id_usuario = R.id_usuario INNER JOIN tutor T ON R.id_tutor = T.id_tutor WHERE T.mail_tutor = '$username'";
			$usuarios = $app['db']->fetchAll($sql);
			return $app['twig']->render('new_device.html', array('usuarios' => $usuarios, 'mac' => $mac,'error' => "El dispositivo ya existe"));
		}
	}
	for ($i = 0; $i < $count; $i++) {//introduzco las relaciones con los usuarios
		$app['db']->insert('dispositivo_usuario', array('id_dispositivo' => $id_dispositivo, 'id_usuario' => $numero[$i]));	
	}
	//introduzo la relacion con el tutor
	$app['db']->insert('tutor_dispositivo', array('id_tutor' => $id_tutor, 'id_dispositivo' => $id_dispositivo,'nombre_dispositivo' => $nombre));
	return $app['twig']->render('tutor.html', array('accion' => "El dispositivo ha sido insertado correctaente"));
})
->bind('newDispositivo')
;


$app->get('/tutor', function () use ($app) {
    return $app['twig']->render('tutor.html', array('accion' => ""));
})
->bind('tutor')
;


$app->get('/viewUser', function (Request $request) use ($app){
	$userName = $request->get('userName');
	if($userName!=""){
		$sql = "select * from usuario where `nombre_usuario`='$userName'";
		$data = $app['db'] -> fetchAll($sql);
		$apellidos = $data[0]["apellidos_usuario"];
		$mail = $data[0]["mail_usuario"];
		$fec_nac = $data[0]["fnac_usuario"];
		$telf = $data[0]["tlfn_usuario"];
		return $app['twig']->render('viewUserSimple.html', array(
															'userName' => $userName, 
															"userSurname" => $apellidos,
															"mail" => $mail,
															"fec_nac" => $fec_nac,
															"telf" => $telf)
		);
	}
    else{
		return $app['twig']->render('tutor.html', array('accion' => ""));
	}
})
->bind('viewUser')
;

$app->get('/configUs', function () use ($app) {
    return $app['twig']->render('config_user.html');
})
->bind('configUs');




$app->get('/verSensor', function () use ($app) {
    return $app['twig']->render('ver_sensor.html');
})
->bind('verSensor');


$app->post('/new_usermac', function (Request $request) use ($app){
	$id_usuario = $request->get('idUsuario');
	$mac = $request->get('mac');
	$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
	$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	if($id_dispositivo==null){
		$app['db']->insert('dispositivo', array('mac_dispositivo' => $mac,'nombre_dispositivo' => $nombre));
		$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
		$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	}
	$app['db']->insert('dispositivo_usuario', array('id_dispositivo' => $id_dispositivo, 'id_usuario' => $id_usuario));
    return $app['twig']->render('tutor.html', array('accion' => "", "id_usuario" =>$id_usuario));
})
->bind('new_usermac')
;

$app->post('/new_user',  function (Request $request) use ($app) {
	$mac = getMAC();
	$id_tutor = $request->get('idTutor');
	$mail = $request->get('usuario_mail');
	$pass =$request->get('pass');
	$nombre =  $request->get('usuario_nombre');
	$apellidos =$request->get('usuario_apellidos');
	$fnac =$request->get('usuario_fnac');
	$tlfn =$request->get('usuario_tlfn');
	$encoder = new MessageDigestPasswordEncoder();
	$encodePass = $encoder->encodePassword($pass, '');
	/*if($discvis==null){
		$discvis=0;
	}
	else{
		$discvis=1;
	}
	if($discaudit==null){
		$discaudit=0;
	}
	else{
		$discaudit=1;
	}
	if($discmotriz==null){
		$discmotriz=0;
	}
	else{
		$discmotriz=1;
	}*/
	$app['db']->insert('usuario', array('mail_usuario' => $mail, 'nombre_usuario' => $nombre,'apellidos_usuario' => $apellidos,'fnac_usuario' => $fnac,'tlfn_usuario' => $tlfn, 'pass_usuario' => $encodePass,'roles'=>'ROLE_USER'));
	$sql = "select id_usuario FROM usuario WHERE mail_usuario = '$mail'";
	$id_usuario = $app['db']->fetchColumn($sql, array(), 0);
	$app['db']->insert('tutor_usuario', array('id_tutor' => $id_tutor, 'id_usuario' => $id_usuario));
	/*
	$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
	$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	if($id_dispositivo==null){
		$app['db']->insert('dispositivo', array('mac_dispositivo' => $mac));
		$sql = "select id_dispositivo FROM dispositivo WHERE mac_dispositivo = '$mac'";
		$id_dispositivo = $app['db']->fetchColumn($sql, array(), 0);
	}
	$app['db']->insert('dispositivo_usuario', array('id_dispositivo' => $id_dispositivo, 'id_usuario' => $id_usuario));
	//$sql = "select id_tutor FROM tutor WHERE mail_tutor = '$tutor'";
	//$id_tutor = $app['db']->fetchColumn($sql, array(), 0);
	
	*/
	return $app['twig']->render('new_usermac.html', array('mac' => $mac, 'id_usuario' => $id_usuario));
})
->bind('new_user')
;	

$app->post('/register', function(Request $request) use ($app){	
	$username =  $request->get('newTutor_name');
	$usermail = $request->get('newTutor_mail');
	$pass = $request->get('newTutor_pass');
	$usersurname = $request->get('newTutor_surname');
	$userphone = $request->get('newTutor_phone');
	$encoder = new MessageDigestPasswordEncoder();
	$encodePass = $encoder->encodePassword($pass, '');
	
	$app['db']->insert('tutor', array('mail_tutor' => $usermail, 'nombre_tutor' => $username, 'tlfn_tutor' => $userphone, 'apellidos_tutor' => $usersurname,'pass_tutor' => $encodePass,'roles'=>'ROLE_USER'));
	
	$params = array(
		'name' => $username,
		'password' => $pass,
		'email' => $usermail,
		'surname' => $usersurname,
		'phone' => $userphone
		);
		
	$subRequest = Request::create('/login_check', 'POST', $params);
	
	
	$response = $app->handle($subRequest, HttpKernelInterface::MASTER_REQUEST, false);
	//response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
	//return $app->redirect('homepage');
	return $app->redirect($app["url_generator"]->generate("homepage"));
	//return $app['twig']->render('tutor.html', array('accion' =>"El tutor ha sido registrado correctamente"));
	//return $app->redirect('/');
	//return $app['twig']->render('homepage', array());	
})
->bind('register')
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
