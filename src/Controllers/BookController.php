<?php

namespace BookshelfApi\Controllers;

use BookshelfApi\Model\BookModel;
use BookshelfApi\Classes\Book;
use PDOException;
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
        if(isset($uploadedBookCover)){
            $imgPath = self::uploadImgAndReturnPath($uploadedBookCover);
            $newBook->__set("imgPath", $imgPath);
        }

        // saving book on DB
        BookModel::save($newBook);

        return $response->withStatus(201);
    }

    public static function update(Request $request, Response $response) {
        // getting new book
        $requestBook = $request->getParsedBody();

        // updating on DB
        $newBook = new Book();
        $newBook->assocArrayToBook($requestBook);
        BookModel::update($newBook);

        return $response->withStatus(200);

    }

    public static function updateBookCover(Request $request, Response $response, $args) {
        $id = $args["id"];

        //getting and deleting the old cover
        $oldBookImgPath = BookModel::getById($id)["imgPath"];

        if(isset($oldBookImgPath))
            unlink(__DIR__ . "/../../$oldBookImgPath");

        $book = new Book();
        $book->__set("id", $args["id"]);

        // uploading and getting the cover path
        $uploadedBookCover = $request->getUploadedFiles()["img"];
        if(isset($uploadedBookCover)) {
            $newBookImgPath = self::uploadImgAndReturnPath($uploadedBookCover);
            // preparing new book
            $book->__set("imgPath", $newBookImgPath);
        }

        // updating book in DB
        BookModel::updateBookCover($book);
        return $response->withStatus(200);
    }

    public static function delete(Request $request, Response $response, $args) {
        $id = $args["id"];

        $bookToDelete = BookModel::getById($id);

        if(isset($bookToDelete)){
            // removing book cover
            $imgPath = $bookToDelete["imgPath"];
            if(isset($imgPath))
                unlink(__DIR__ . "/../../$imgPath");

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


