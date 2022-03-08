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
            $query  = "SELECT id, title, description, author, imgPath FROM books";
            $con = Connection::create();
            $state  = $con->query($query);
            $result = $state->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $error) {
            throw $error;
            return null;
        }
    }


    public static function getById($id) {
        try{
            $query = "SELECT id, title, description, author, imgPath FROM books WHERE id = ?";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $id
            ]);

            $result = $state->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch(PDOException $error) {
            throw $error;
        }
    }


    public static function save(Book $book) {
        try{
            $query = "INSERT INTO books (title, description, author, imgPath) VALUES (?,?,?,?)";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $book->__get("title"),
                $book->__get("description"),
                $book->__get("author"),
                $book->__get("imgPath")

            ]);
        } catch(PDOException $error) {
            throw $error;
        }
   }


    public static function update(Book $book) {
        try{
            $query = "UPDATE books SET title = ?, description = ?, author = ?, imgPath = ? WHERE id = ?";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $book->__get("title"),
                $book->__get("description"),
                $book->__get("author"),
                $book->__get("imgPath"),
                $book->__get("id")
            ]);
        } catch(PDOException $error) {
            throw $error;
        }
    }

    public static function updateBookCover(Book $book) {
        try{
            $query = "UPDATE books SET imgPath = ? WHERE id = ?";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $book->__get("imgPath"),
                $book->__get("id")
            ]);
        } catch(PDOException $error) {
            throw $error;
        }
    }


    public static function delete($id) {
        try{
            $query = "DELETE FROM books WHERE id = ?";
            $con = Connection::create();
            $state = $con->prepare($query);
            $state->execute([
                $id
            ]);
        } catch(PDOException $error) {
            throw $error;
        }
    }
}
