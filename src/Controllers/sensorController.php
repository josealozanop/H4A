
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

$app->get('/nuevoSensor', function (Request $request) use ($app) {
	$sql = "SELECT * FROM habitacion";
    $habitacion = $app['db']->fetchAll($sql);	
    return $app['twig']->render('new_sensor.html', array('habitaciones' => $habitacion, 'error' => ""
	));
})
->bind('nuevoSensor')
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

$app->get('/verSensor', function () use ($app) {
    return $app['twig']->render('ver_sensor.html');
})
->bind('verSensor');

?>