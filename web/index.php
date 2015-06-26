<?php
ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../src/Controllers/userController.php';
require __DIR__.'/../src/Controllers/homeController.php';
require __DIR__.'/../src/Controllers/tutorController.php';
require __DIR__.'/../src/Controllers/deviceController.php';
require __DIR__.'/../src/Controllers/sensorController.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';
$app->run();
