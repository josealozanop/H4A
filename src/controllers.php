<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
//Request::setTrustedProxies(array('127.0.0.1'));


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

$app->get('/hola', function () use ($app) {
	$variable="hola";
	$usuarios = $app['db']->fetchAll('SELECT nUsuario_tutor FROM tutor');
	$text = json_encode($usuarios); 
	$tam = count ($usuarios);
    return $app['twig']->render('vacia.html', array(
	'variable' => $usuarios,
	'tam' => $tam,
	'text' => $text
	));
})
->bind('hola')
;

$app->get('/get/tutors', function () use ($app) {
	$tutores = $app['db']->fetchAll('SELECT nUsuario_tutor FROM tutor');
	$usuarios = $app['db']->fetchAll('SELECT nUsuario_usuario FROM usuario');
	$text = '['.json_encode($usuarios).','.json_encode($tutores).']'; 
	return new Response($text);
})
;


$app->get('/verdisc', function (Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
	//$variable="hola";
	$username= $user->getUsername();
	$sql = "SELECT * FROM discapacitados D INNER JOIN user_disc R ON D.id_disc = R.id_disc INNER JOIN users U ON R.id_user = U.id_user WHERE U.username = '$username'";
    $discapacitados = $app['db']->fetchAll($sql);
	
    return $app['twig']->render('verdisc.html', array(
	'discapacitados' => $discapacitados
	));
})
->bind('verdisc')
;

$app->get('/newuser', function () use ($app) {
$ipAddress=$_SERVER['REMOTE_ADDR'];
			$comando=false;
			if(($ipAddress==$_SERVER['SERVER_ADDR'] || $ipAddress=='127.0.0.1' || $ipAddress=='::1') && (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
				$comando = 'ipconfig /all';
				ob_start();
				system($comando);
				$mycom=ob_get_contents();
				ob_clean();
				$findme = "sica";
				$pmac = strpos($mycom, $findme);
				$mac=substr($mycom,($pmac+32),17);
			}
			else{
				$mac=false;
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
					$comando = 'arp -a ';
					ob_start();
					$arp=system($comando.$ipAddress);
					ob_clean();
					$lines=explode("\n", $arp);
					foreach($lines as $line)
					{
					   $cols=preg_split('/\s+/', trim($line));
					   if ($cols[0]==$ipAddress)
					   {
						   $mac=$cols[1];
					   }
					}
				} else {
					$comando = 'arp -a | grep '.$ipAddress.' | awk \'{print $4}\'';
					$mac=system($comando);
				}
			}
    return $app['twig']->render('newuser.html', array('mac' => $mac));
})
->bind('newuser')
;

$app->get('/tutor', function () use ($app) {
    return $app['twig']->render('tutor.html', array());
})
->bind('tutor')
;

$app->post('/registerdisc', function(Request $request) use ($app){	
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
	$app['db']->insert('discapacitados', array('discuser' => $username, 'discnombre' => $nombre, 'discpass' => $encodePass,'discmac'=>$mac,'discvis'=>$discvis,'discaudit'=>$discaudit,'discmotriz'=>$discmotriz));
	
	return $app->redirect($app["url_generator"]->generate("tutor"));
})
->bind('registerdisc')
;	

$app->post('/register', function(Request $request) use ($app){	
	$username =  $request->get('email');
	$pass =$request->get('password');
	$encoder = new MessageDigestPasswordEncoder();
	$encodePass = $encoder->encodePassword($pass, '');
	
	$app['db']->insert('tutor', array('nUsuario_tutor' => $username, 'pass_tutor' => $encodePass,'roles'=>'ROLE_USER'));
	
	$params = array(
		'email' => $username,
		'password' => $pass
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
 
