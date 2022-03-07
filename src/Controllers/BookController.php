<?php

namespace BookshelfApi\Controllers;

use BookshelfApi\Model\BookModel;
use BookshelfApi\Classes\Book;

// slim
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController
{
    public static function getAll(Request $request, Response $response){
        $jsonBooks = json_encode(BookModel::getAll());

        $response
            ->getBody()
            ->write($jsonBooks);

        return $response
            ->withHeader("Content-Type", "application/json");
    }

    public static function getById(Request $request, Response $response, $args) {
        $jsonBook = json_encode(BookModel::getById($args["id"]));

        $response
            ->getBody()
            ->write($jsonBook);

        return $response
            ->withHeader("Content-Type", "application/json");


    }

    public static function save(Request $request, Response $response) {
        $requestBook = $request->getParsedBody();
        $newBook = new Book();
        $newBook->assocArrayToBook($requestBook);

        // uploading book cover
        $uploadedBookCover = $request->getUploadedFiles()["img"];
        if(isset($uploadedBookCover)) {
            // generating a new name for the img
            $tempName = $uploadedBookCover->getClientFilename();
            $fileExtension = explode(".", $tempName)[1];
            $newName = sha1($tempName . time()) . ".$fileExtension";

            // uploading
            $path = __DIR__ . "/../../uploads/$newName";
            $uploadedBookCover
                ->moveTo($path);

            // adding the cover imgPath to book
            $newBook->__set("imgPath", "uploads/" . $newName);
        }

        // saving book on DB
        BookModel::save($newBook);


        $response
            ->withStatus(201);

        return $response;
    }
}
