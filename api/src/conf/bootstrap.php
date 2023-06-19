<?php

use Slim\Factory\AppFactory;
use minipress\api\services\Eloquent\Eloquent;

// Crée l'app et le moteur de templates
$app = AppFactory::create();

// Ajoute le routing middleware
$app->addRoutingMiddleware();

// Ajoute le middleware d'erreurs
$app->addErrorMiddleware(true, false, false);

// Définit le chemin de base
$app->setBasePath('');

// Initialise Eloquent avec le fichier de configuration
Eloquent::init(__DIR__ . '/../conf/api.conf.ini');

// Initialise la session
session_start();

return $app;