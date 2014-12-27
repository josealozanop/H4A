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


	return $app->redirect($app["url_generator"]->generate("homepage"));
	//return $app['twig']->render('index.html', array());
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
$app->get('/admin', function () use ($app) {
	$variable="hola";
    return $app['twig']->render('registro.html', array(
	'variable' => $variable
	));
})
->bind('admin')
;

$app->post('/register', function(Request $request) use ($app){
 
	
	$username =  $request->get('email');
	$pass =$request->get('password');
	$encoder = new MessageDigestPasswordEncoder();
	$encodePass = $encoder->encodePassword($pass, '');
	
	$app['db']->insert('users', array('username' => $username, 'password' => $encodePass,'roles'=>'ROLE_USER'));
	
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
 
