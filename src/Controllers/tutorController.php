
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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

$app->get('/tutor', function () use ($app) {
    return $app['twig']->render('tutor.html', array('accion' => ""));
})
->bind('tutor')
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
	return $app->redirect($app["url_generator"]->generate("homepage"));
})
->bind('register')
;
?>