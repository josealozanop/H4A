
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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
		$app['db']->update('sensoractuador', array(
		'id_habitacion'=>$id_habitacion), array('id_sen'=>$id
	));
	}
	return $app['twig']->render('tutor.html', array('accion' =>"habitacion creada correctamente $nombre_hab "
	));
})
->bind('newHabitacion')
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
->bind('nuevaHabitacion');

$app->get('/getRooms', function (Request $request) use ($app) {
			
	$out = array(
		"data" => null,
		"status" => 0,
		"error_msg" => ""
	);
	
	$dbRooms = new DAO_rooms($app['db']);
	$ids = $dbRooms->getRooms();
	$values = array();
	foreach($ids as $id){
		$room = $dbRooms->getRoom($id);
		array_push($values, $room->toArray());			
	}
	
	$out["status"] = 1;
	$out["data"] = array(
		"rooms" => $values
	);
	
	$out = json_encode($out, true);
	return new Response($out);
})->bind("getRooms");


?>