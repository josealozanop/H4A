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


$app->get('/', function(Request $request) use ($app) {
    return $app['twig']->render('index.html', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
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



$app->post('/opUsuarios', function (Request $request) use ($app) {

switch($_POST["enviar"]) { 
    case 1:
        //aca el caso de presionar el primero 
        break; 
    case 2: 
        return $app['twig']->render('newuser.html', array('mac' => '1', 'id_tutor'=>'1'));
        break; 
    case 3: 
        $id_usuario = $request->get('idUsuario');
		$app['db']->delete('usuario', array('id_usuario' => $id_usuario));	
		return $app->redirect($app["url_generator"]->generate("verdisc"));
        break; 
}  

if ($_POST[ver]) {  }


if ($_POST[ver]) {  }


if ($_POST[editar]) {   }
	
})
->bind('opUsuarios')
;

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

//modificar un tutor
$app->get('/modTutor', function (Request $request) use ($app) {
	$userMail = $app['security']->getToken()->getUser()->getUsername(); //cuidado, esta funcion devuelve el correo no el nombre
	$query = 'SELECT * FROM tutor WHERE mail_tutor = "'.$userMail.'"';
	$data = $app['db']->fetchAll($query);
    return $app['twig']->render('mod_tutor.html', array( 'user' => $data));
	
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


$app->get('/newDevice', function (Request $request) use ($app) {
	$mac = getMAC();
    return $app['twig']->render('new_device.html', array( 'mac' => $mac));
	
})
->bind('newDevice')
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
    return $app['twig']->render('tutor.html', array());
})
->bind('tutor')
;

$app->post('/registerdisc',  function (Request $request) use ($app) {

	$id_tutor = $request->get('idTutor');
	$username = $request->get('discuser');
	$pass =$request->get('discpass');
	$nombre =  $request->get('discnom');
	$discvis =$request->get('discvis');
	$discmotriz =$request->get('discmotriz');
	$discaudit =$request->get('discaudit');
	$mac =$request->get('discmac');
	$encoder = new MessageDigestPasswordEncoder();
	$encodePass = $encoder->encodePassword($pass, '');
	if($discvis==null){
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
	}
	$app['db']->insert('usuario', array('mail_usuario' => $username, 'nombre_usuario' => $nombre, 'pass_usuario' => $encodePass,'roles'=>'ROLE_USER'));
	$sql = "select id_usuario FROM usuario WHERE mail_usuario = '$username'";
	$id_usuario = $app['db']->fetchColumn($sql, array(), 0);
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
	$app['db']->insert('tutor_usuario', array('id_tutor' => $id_tutor, 'id_usuario' => $id_usuario));
	
	return $app->redirect($app["url_generator"]->generate("tutor"));
})
->bind('registerdisc')
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
		
	switch ($type_service) {
		case 'getMyData':
			$user = $app['security']->getToken()->getUser();
			$tutor_mail= $user->getUsername();
			$query = "select mail_tutor, nombre_tutor FROM tutor WHERE mail_tutor = '$tutor_mail'";
			$data = $app['db']->fetchAll($query);
			$out = json_encode($data);
			//$out = json_encode($data); 
			break;
		default:
			$out = "Service ".$type_service.' was not found';
			break;
	}
	
    return new Response($out);
})
->bind('serviceController')
;

/*
$type_service = $_GET['service'];
$out = 'Service '.$type_service.' does not exist';

switch ($type_service) {
    case 'getMyData':
        $out = getMyData();
        break;
    case 'ping':
        $out = ping('');
        break;
    case 2:
        echo "i es igual a 2";
        break;
}


echo $out;

function ping($in){
	if($in!='') return $in;
	return 'pong';
}

function getMyData($app)  {
	$conn->fetchAll('SELECT mail_tutor FROM tutor');
	return 'amosss';
}	*/
