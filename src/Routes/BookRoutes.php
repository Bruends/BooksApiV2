<?php

namespace BookshelfApi\Routes;

use BookshelfApi\Controllers\BookController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookRoutes
{
    public static function addRoutes($app){
        $app->get('/books', function (Request $request, Response $response) {
            return BookController::getAll($request, $response);
        });

        $app->get('/books/{id}', function (Request $request, Response $response, $args) {
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

        return $app;
    }
}
