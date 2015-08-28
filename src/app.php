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
	'host'			=> 'localhost',//'asistic.ugr.es',
	'dbname'		=> 'home4all',
	'user'			=> 'root',//'HOME4ALL',
	'password'		=> '',
	'charset'		=> 'utf8',
	//'port'			=> '3306'
	),
	));
$app['debug'] = false;
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
		'register' => array('pattern' => '^/register'), // Example of an url available as anonymous user
		'newTutor' => array('pattern' => '^/newTutor'),
	//	'login' => array('pattern' => '^/login'),
		//'tutor' => array('pattern' => '^/tutor'),
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
		array('^/$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/index*', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		//array('^/tutor', !'ROLE_USUARIO'),
		array('^/login$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/register', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/newTutor', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/userSelection', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/homeController.*$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/setSensor.*$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/getSensorsValues.*$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/insertPass', 'IS_AUTHENTICATED_ANONYMOUSLY'),
		array('^/checkPassword', 'IS_AUTHENTICATED_ANONYMOUSLY')
		array('^/.+$', 'IS_AUTHENTICATED_FULLY')
	)
));

return $app;
