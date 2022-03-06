<?php
require_once __DIR__ . '/vendor/autoload.php';

use BookshelfApi\Model\BookModel;
use BookshelfApi\Classes\Book;


$book = new Book("test", "teste", "teste", null, "38");

BookModel::delete("38");

print_r(BookModel::getById("38"));
