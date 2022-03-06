<?php
require_once __DIR__ . '/vendor/autoload.php';

use BookshelfApi\Model\BookModel;
use BookshelfApi\Classes\Book;


var_dump(BookModel::getAll());
echo "====\n";

$test = new Book("Um dia serei Feliz", "ou sera q não", "bruno");

BookModel::save($test);

var_dump(BookModel::getAll());