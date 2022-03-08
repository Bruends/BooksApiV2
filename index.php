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

$app = BookMiddlewares::addMiddlewares($app);

$app = BookRoutes::addRoutes($app);

$app->run();
