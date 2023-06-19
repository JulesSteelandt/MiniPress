<?php
declare(strict_types=1);
ini_set('display_errors', '1');

require_once __DIR__ . '/../vendor/autoload.php';

/* Application bootstrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';

/* CORS middleware */
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

/* Routes loading */
(require_once __DIR__ . '/../src/conf/routes.php')($app);

$app->run();
