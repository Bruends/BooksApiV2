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

        return $response->withHeader("Content-Type", "application/json");
    }

    public static function getById(Request $request, Response $response, $args) {
        $jsonBook = json_encode(BookModel::getById($args["id"]));

        $response
            ->getBody()
            ->write($jsonBook);

        return $response->withHeader("Content-Type", "application/json");


    }

    public static function save(Request $request, Response $response) {
        $requestBook = $request->getParsedBody();
        $newBook = new Book();
        $newBook->assocArrayToBook($requestBook);

        // uploading book cover
        $uploadedBookCover = $request->getUploadedFiles()["img"];

        $imgPath = self::uploadImgAndReturnPath($uploadedBookCover);
        $newBook->__set("imgPath", $imgPath);


        // saving book on DB
        BookModel::save($newBook);


        return $response->withStatus(201);
    }

    public static function delete(Request $request, Response $response, $args) {
        $id = $request->getParsedBody()["id"];

        $bookToDelete = BookModel::getById($id);

        if(isset($bookToDelete)){
            // removing book cover
            $imgPath = $bookToDelete["imgPath"];
            if(isset($imgPath))
                unlink( __DIR__ . "/../../$imgPath");

            // deleting book
            BookModel::delete($id);

            return $response->withStatus(200);
        }

    }



    // upload a book cover and return it's path
    public static function uploadImgAndReturnPath($uploadedBookCover){
        // uploading book cover
        if(isset($uploadedBookCover)) {
            // generating a new name for the img
            $tempName = $uploadedBookCover->getClientFilename();
            $fileExtension = explode(".", $tempName)[1];
            $newName = sha1($tempName . time()) . ".$fileExtension";

            // uploading
            $path = __DIR__ . "/../../uploads/$newName";
            $uploadedBookCover
                ->moveTo($path);

            return "uploads/$newName";
        }

        return null;
    }
}


