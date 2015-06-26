
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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

?>