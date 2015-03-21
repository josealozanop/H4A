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


$app->get('/', function(Request $request) use ($app) {
    return $app['twig']->render('index.html', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),'accion'=>""
    ));	
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

$app->get('/pepe', function () use ($app) {
	$variable="hola";
    return $app['twig']->render('registro.html', array(
	'variable' => $variable
	));
})
->bind('pepe')
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
		$sql = "SELECT mail_usuario FROM usuario where id_usuario='$uDefecto_Dispositivo'";
		$uDef = $app['db']->fetchAll($sql);
		$sql = "SELECT * FROM usuario U INNER JOIN dispositivo_usuario R ON U.id_usuario = R.id_usuario INNER JOIN dispositivo D ON R.id_dispositivo = D.id_dispositivo WHERE D.id_dispositivo = '$id_dispositivo'";
		$usuarios = $app['db']->fetchAll($sql);
		return $app['twig']->render('verDispositivo.html', array('uDef' => $uDef,'usuarios' => $usuarios,'editar' =>$editar,'mac' => $mac,
		'id_dispositivo' => $id_dispositivo,'uDefecto_Dispositivo'=>$uDefecto_Dispositivo,'nombre_dispositivo' => $nombre_dispositivo,'mac_dispositivo' => $mac_dispositivo,'error'=>""));
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
	/*return $app['twig']->render('verUsuario.html', array('editar' =>"true",
	'usuario' => $usuario
	));*/
	
})
->bind('modUsuario')
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

$app->get('/vacia', function () use ($app) {
	$variable="vacia";
	$usuarios = $app['db']->fetchAll('SELECT mail_tutor FROM tutor');
	$text = json_encode($usuarios); 
	$tam = count ($usuarios);
    return $app['twig']->render('vacia.html', array(
	'variable' => $usuarios,
	'tam' => $tam,
	'text' => $text
	));
})
->bind('vacia')
;

//crear nuevo tutor
$app->get('/newTutor', function(Request $request) use ($app) {

    return $app['twig']->render('new_tutor.html', array(
		'error' => $app['security.last_error']($request),
		'last_username' => $app['session']->get('_security.last_username')
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

$app->get('/newuser', function () use ($app) {
	$mac = getMAC();
	$user = $app['security']->getToken()->getUser();
	$id_tutor= $user->getId();
    return $app['twig']->render('newuser.html', array('mac' => $mac, 'id_tutor'=>$id_tutor));
})
->bind('newuser')
;

$app->get('/tutor', function () use ($app) {
    return $app['twig']->render('tutor.html', array('accion' => ""));
})
->bind('tutor')
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
    return $app['twig']->render('tutor.html', array('accion' => ""));
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
		
	switch ($type_service) {
		
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
			
		case "addDevice":
			$device_name = $request->get('name');
			$device_mac = $request->get('MAC');
			$out = $device_name.$device_mac;
			break;
			
		case "getMyDevices":
			$out = json_encode(get_my_devices($app['db'], $tutor_id));
			break;
			
		default:
			$out = "Service ".$type_service.' was not found';
			break;
	}
	
    return new Response($out);
})
->bind('serviceController')
;
