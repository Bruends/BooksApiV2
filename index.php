<?php
require_once __DIR__ . '/vendor/autoload.php';

use BookshelfApi\Model\BookModel;
use BookshelfApi\Classes\Book;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $jsonBooks = json_encode(BookModel::getAll());

    $response
        ->getBody()
        ->write($jsonBooks);

    return $response->withHeader('Content-type', 'application/json');;
});

$app->run();
