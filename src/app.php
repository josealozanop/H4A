<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' 	=> array(
	'driver' 		=> 'pdo_mysql',
	'host'			=> 'localhost',
	'dbname'		=> 'prueba',
	'user'			=> 'root',
	'password'		=> '',
	'charset'		=> 'utf8',
	),
	));
$app['debug'] = false;
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
		'register' => array('pattern' => '^/register'), // Example of an url available as anonymous user		
        'default' => array(
            'pattern' => '^.*$',
            'anonymous' => true, // Needed as the login path is under the secured area
            'form' => array('login_path' => '/', 
							'check_path' => '/login_check',
							'username_parameter' => 'email',
							'password_parameter' => 'password',
							'default_target_path' => '/',
							'require_previous_session' => false),
            'logout' => array('logout_path' => '/logout'), // url to call for logging out
            'users' => $app->share(function() use ($app) {
                // Specific class App\User\UserProvider is described below
                return new App\User\UserProvider($app['db']);
            }),
        ),
    ),
    'security.access_rules' => array(
        // You can rename ROLE_USER as you wish
        array('^/.+$', 'ROLE_USER'),
        array('^/register$', ''), // This url is available as anonymous user
    )
));

return $app;
