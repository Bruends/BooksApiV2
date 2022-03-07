<?php

namespace BookshelfApi\Controllers;

use BookshelfApi\Model\BookModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController
{
    public static function getAll(Request $request, Response $response){
        $jsonBooks = json_encode(BookModel::getAll());

        $response
            ->withHeader("Content-type", "application/json")
            ->getBody()
            ->write($jsonBooks);

        return $response;
    }

    public static function getById(Request $request, Response $response, $args) {
        $jsonBook = json_encode(BookModel::getById($args["id"]));

        $response
            ->withHeader("Content-type", "application/json")
            ->getBody()
            ->write($jsonBook);

        return $response;
    }
}
