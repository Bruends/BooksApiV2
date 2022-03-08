<?php
require_once __DIR__ . '/vendor/autoload.php';

use BookshelfApi\Controllers\BookController;

// slim
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// enabling CORS
$app->add(function(Request $request, RequestHandler $handler){

    $response = $handler->handle($request);

    return $response
        ->withHeader("Access-Control-Allow-Origin", "*")
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get('/books', function (Request $request, Response $response) {
   return BookController::getAll($request, $response);
});

$app->get('/books/find/{id}', function (Request $request, Response $response, $args) {
    return BookController::getById($request, $response, $args);
});

$app->post('/books', function(Request $request, Response $response){
    return BookController::save($request, $response);
});

$app->post('/books/newCover/{id}', function(Request $request, Response $response, $args){
    return BookController::updateBookCover($request, $response, $args);
});

$app->delete('/books/{id}', function(Request $request, Response $response, $args){
    return BookController::delete($request, $response, $args);
});

$app->put('/books', function(Request $request, Response $response){
    return BookController::update($request, $response);
});

$app->run();
