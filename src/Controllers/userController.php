
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/newuser', function () use ($app) {
	$mac = getMAC();
	$user = $app['security']->getToken()->getUser();
	$id_tutor= $user->getId();
    return $app['twig']->render('newuser.html', array('mac' => $mac, 'id_tutor'=>$id_tutor));
})
->bind('newuser')
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


?>