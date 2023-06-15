<?php

use minipress\api\src\services\Eloquent\Eloquent;
use Slim\Factory\AppFactory;

// crée l'app et le moteur de templates
$app = AppFactory::create();

// ajoute le routing et l'erreur middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('');

// initialise Eloquent avec le fichier de config
Eloquent::init(__DIR__ . '/../conf/conf.ini');

session_start();

return $app;
