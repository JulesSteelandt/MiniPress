<?php

use minipress\admin\services\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;


session_start();
// crée l'app et le moteur de templates
$app = AppFactory::create();
// crée le moteur de templates twig
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null;
}
$twig->getEnvironment()->addGlobal("userLog",($_SESSION['user']!=null));
$twig->getEnvironment()->addGlobal("userAdmin",($_SESSION['user']!=null && $_SESSION['user']->statut==2));
$twig->getEnvironment()->addGlobal("userGlobal",($_SESSION['user']));

// ajoute le routing et l'erreur middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('');

// ajoute twig à l'app
$app->add(TwigMiddleware::create($app, $twig));

// initialise Eloquent avec le fichier de config
Eloquent::init(__DIR__ . '/../conf/admin.conf.ini');


return $app;