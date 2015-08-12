
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

require_once( __DIR__."/../utils/userAssets.php");

$app->get('/newuser', function () use ($app) {
	$mac = getMAC();
	$user = $app['security']->getToken()->getUser();
	$id_tutor= $user->getId();
    return $app['twig']->render('newuser.html', array('mac' => $mac, 'id_tutor'=>$id_tutor));
})
->bind('newuser')
;
$app->post('/busmodUsuario', function (Request $request) use ($app) {
	$id_usuario = $request->get('usuario_id');
	$editar="false";
	$sql = "select * FROM usuario WHERE id_Usuario = '$id_usuario'";
	$usuario = $app['db']->fetchAll($sql);	
	return $app['twig']->render('verUsuario.html', array('editar' =>$editar,
	'usuario' => $usuario,'error' =>""
	));
})
->bind('busmodUsuario')
;
$app->post('/opUsuarios', function (Request $request) use ($app) {
$id_usuario = $request->get('idUsuario');
switch($_POST["enviar"]) { 
    case 1:
		$editar="true";
        $sql = "select * FROM usuario WHERE id_Usuario = '$id_usuario'";
		$usuario = $app['db']->fetchAll($sql);	
		return $app['twig']->render('verUsuario.html', array('editar' =>$editar,
		'usuario' => $usuario,'error' =>""
		));
        break; 
    case 2: 
		$editar="false";
        $sql = "select * FROM usuario WHERE id_Usuario = '$id_usuario'";
		$usuario = $app['db']->fetchAll($sql);	
		return $app['twig']->render('verUsuario.html', array('editar' =>$editar,
		'usuario' => $usuario,'error' =>""
		));
        break; 
    case 3: 
		$app['db']->delete('usuario', array('id_usuario' => $id_usuario));	
		return $app->redirect($app["url_generator"]->generate("verdisc"));
        break;
	} 	
})
->bind('opUsuarios')
;

$app->post('/modUsuario', function (Request $request) use ($app) {
	$id_usuario = $request->get('id_usuario');
	$mail = $request->get('usuario_mail');
	$nombre =  $request->get('usuario_nombre');
	$apellidos =$request->get('usuario_apellidos');
	$fnac =$request->get('usuario_fnac');	
	$tlfn =$request->get('usuario_tlfn');	
	$oldpass =$request->get('usuario_oldpass');	
	$oldmail =$request->get('usuario_oldmail');	
	$pass =$request->get('pass');	
	if($mail!=$oldmail){
		$sql = "select id_usuario FROM usuario WHERE mail_usuario = '$mail'";
		$mailRep = $app['db']->fetchColumn($sql, array(), 0);
		if($mailRep!=null){
			$editar="false";
			$sql = "select * FROM usuario WHERE id_usuario = '$id_usuario'";
			$usuario = $app['db']->fetchAll($sql);	
			return $app['twig']->render('verUsuario.html', array('editar' =>$editar,
			'usuario' => $usuario,'error' => "Ya ese correo asociado a un usuario"
			));
			}		
	}
	if($pass=="passpordefecto"){
		$pass=$oldpass;
	}
	$app['db']->update('usuario', array(
		'nombre_usuario'=>$nombre,'mail_usuario'=>$mail,'apellidos_usuario'=>$apellidos,'pass_usuario'=>$pass,'fnac_usuario'=>$fnac,'tlfn_usuario'=>$tlfn), array('id_usuario'=>$id_usuario
	));
	$sql = "select * FROM usuario WHERE id_Usuario = '$id_usuario'";
	$usuario = $app['db']->fetchAll($sql);	
	return $app['twig']->render('tutor.html', array('accion' =>"Usuario modificado correctamente"
	));	
})
->bind('modUsuario')
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
	if($indexDefault>-1) {
		link_defualtUser_device($app['db'],$ids[$indexDefault],$idUsuario);
		$out = $out."<br> el dispositivo con id $ids[$indexDefault] tendrá como user por defecto el que tiene como id $idUsuario";
	}
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
	$ids_devices = get_user_devices($app['db'], $idUsuario);
	$devicesData = get_devices_data($app['db'], $ids_devices);
	$names = array();
	foreach($ids_devices as $id){
		$newName = get_device_name($app['db'],$id, $tutor_id);
		array_push($names, $newName);
	}
	link_user_sensors($app['db'], $idUsuario, $ids);
	
	return $app['twig']->render('configUser.html', array('idUsuario' =>$idUsuario, "devicesData" => json_encode($devicesData), "names" =>  base64_encode ( json_encode($names))
	));
})
->bind('enableSensors');

$app->get('/verdisc', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
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
	if($pass == ""){
		$encodePass = NULL;
	}
	else{
		$encoder = new MessageDigestPasswordEncoder();
		$encodePass = $encoder->encodePassword($pass, '');
	}
	
	/*
	$nombre_fichero= $request->files->get('campofotografia');// $request->getFiles('campofotografia');
	$directorio_destino = $mail;
	$serv = "/";


	$ruta = $serv . $directorio_destino;
	if(!file_exists($ruta))	mkdir($ruta);
	
	if($nombre_fichero){
		$nombre_fichero->move($ruta, $nombre_fichero->getClientOriginalName());
	}
	
	//Si el usuario no tiene su carpeta creada se la hacemos
	$userDir = "C:/wamp/www/H4A/users/".$mail;
	if(!is_dir($userDir)){
		mkdir($userDir);
	}*/
	
	
	
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
	$app['db']->insert('usuario', array('mail_usuario' => $mail, 'nombre_usuario' => $nombre,'apellidos_usuario' => $apellidos,'fnac_usuario' => $fnac,'tlfn_usuario' => $tlfn, 'pass_usuario' => $encodePass,'roles'=>'ROLE_USER'));
	$sql = "select id_usuario FROM usuario WHERE mail_usuario = '$mail'";
	$id_usuario = $app['db']->fetchColumn($sql, array(), 0);
	
	$assetsManager = new userAssets($id_usuario);
	$assetsManager->createDir();
	$img = $request->files->get('campofotografia');
	
	if($img){
		$extension = (new SplFileInfo($img->getClientOriginalName()))->getExtension();
		$request->files->get('campofotografia')->move($assetsManager->getFullPath(), "profileImg.".$extension);
	}
	
	
	$app['db']->insert('tutor_usuario', array('id_tutor' => $id_tutor, 'id_usuario' => $id_usuario));
	return $app['twig']->render('new_usermac.html', array('mac' => $mac, 'id_usuario' => $id_usuario));
})
->bind('new_user')
;	

$app->post('/saveConfig', function (Request $request) use ($app){
	$data = $request->get('send');
	$userConfig = new Config();
	$userConfig->fromBase64($data);
	return $app['twig']->render('tutor.html', array('accion' => $userConfig->toJson()));
})->bind('saveConfig');

$app->get('/configUs', function () use ($app) {
    return $app['twig']->render('config_user.html');
})
->bind('configUs');

$app->get('/viewUser', function (Request $request) use ($app){
	$userName = $request->get('userName');
	if($userName!=""){
		$sql = "select * from usuario where `nombre_usuario`='$userName'";
		$data = $app['db'] -> fetchAll($sql);
		$id = $data[0]["id_usuario"];
		$apellidos = $data[0]["apellidos_usuario"];
		$mail = $data[0]["mail_usuario"];
		$fec_nac = $data[0]["fnac_usuario"];
		$telf = $data[0]["tlfn_usuario"];
		return $app['twig']->render('viewUserSimple.html', array(
															'id' => $id,
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
})->bind('viewUser');

$app->get('/setAssets', function (Request $request) use ($app){
	$idUsuario = $request->get('idUsuario');
	return $app['twig']->render('setAssets.html', array('idUsuario' => $idUsuario));
})->bind('setAssets');

$app->post('/updateAssets', function (Request $request) use ($app){
	//return $app->redirect('/H4A/web/tutor');
	//$dbUsers = new DAO_users($app["db"]);
	
	$idUsuario = $request->get('idUsuario');
	$assetsManager = new userAssets($idUsuario);
	$assetsManager->createDir();
	//echo $assetsManager->getFullPath();
	//$user = $dbUsers->getUser($idUsuario);
	//$idUsuario = 55;
	
	$roomsJson = $request->get('rooms');
	$rooms = json_decode($roomsJson, true);
	
	//$roomsIds = array_column($rooms, "id_habitacion");
	$roomsIds = array();
	foreach($rooms as $room){
		array_push($roomsIds, $room["id_habitacion"]);
	}
	
	$sensorsJson = $request->get('sensors');
	$sensors = json_decode($sensorsJson, true);
	//$sensorsIds = array_column($sensors, "id_sen");
	$sensorsIds = array();
	foreach($sensors as $sensor){
		array_push($sensorsIds, $sensor["id_sen"]);
	}
	
	$fotos = array();
	foreach($roomsIds as $id){
		//echo($id);
		if($request->files->get($id)){
			//$fotos[$id] = $request->files->get($id);
			array_push($fotos, array(
				"file" => $request->files->get($id),
				"name" => $id.'.'.((new SplFileInfo($request->files->get($id)->getClientOriginalName()))->getExtension())
			));
		}
	}
	
	$fotosSensores = array();
	foreach($sensorsIds as $id){
		//echo($id);
		if($request->files->get("sensor".$id)){
			array_push($fotosSensores, array(
				"file" => $request->files->get("sensor".$id),
				"name" => $id.'.'.((new SplFileInfo($request->files->get("sensor".$id)->getClientOriginalName()))->getExtension())
			));
		}
		
		if($request->files->get("sensor".$id."ON")){
			array_push($fotosSensores, array(
				"file" => $request->files->get("sensor".$id."ON"),
				"name" => $id.'ON'.'.'.((new SplFileInfo($request->files->get("sensor".$id."ON")->getClientOriginalName()))->getExtension())
			));
		}
		
		if($request->files->get("sensor".$id."OFF")){
			array_push($fotosSensores, array(
				"file" => $request->files->get("sensor".$id."OFF"),
				"name" => $id.'OFF'.'.'.((new SplFileInfo($request->files->get("sensor".$id."OFF")->getClientOriginalName()))->getExtension())
			));
		}
	}
	
	
	foreach($fotos as $foto){
		$foto["file"]->move($assetsManager->getFullPath()."/rooms/", $foto["name"]);
	}
	
	foreach($fotosSensores as $foto){
		$foto["file"]->move($assetsManager->getFullPath()."/sensors/", $foto["name"]);
	}
	
	//$out = count($fotos);
	return $app->redirect('/H4A/web/tutor?status=1');
})->bind('updateAssets');

?>