<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use BookshelfApi\Middlewares\BookMiddlewares;
use BookshelfApi\Routes\BookRoutes;

use Slim\Factory\AppFactory;

// slim app config
$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// adding middlewares
$app = BookMiddlewares::addMiddlewares($app);
// adding routes
$app = BookRoutes::addRoutes($app);

$app->run();
