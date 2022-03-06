<?php

namespace BookshelfApi\Model;

use BookshelfApi\Model\Connection;
use BookshelfApi\Classes\Book;
use PDO;
use PDOException;


class BookModel 
{ 
    // return an associative array with all books
    public static function getAll() {
        try {
            // getting results from db
            $query  = "SELECT id, title, description, author FROM books";
            $con = Connection::create();
            $state  = $con->query($query);
            $result = $state->fetchAll(PDO::FETCH_ASSOC);   

            return $result;
        } catch (PDOException $error) {
            throw $error->getMessage();
        }
    }

    public static function save(Book $book) {
        try{
            $query = "INSERT INTO books (title, description, author) VALUES (?,?,?)";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $book->__get("title"),
                $book->__get("description"),
                $book->__get("author")
            ]);
        } catch(PDOException $error) {
            throw $error->getMessage();
        } 
   }
}

