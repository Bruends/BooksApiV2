<?php
require_once __DIR__ . '/vendor/autoload.php';

use BookshelfApi\Controllers\BookController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {
   return BookController::getAll($request, $response);
});

$app->get('/{id}', function (Request $request, Response $response, $args) {
    return BookController::getById($request, $response, $args);
});

$app->run();
