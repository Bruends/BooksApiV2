<?php

namespace BookshelfApi\Model;

require_once __DIR__ . "/../../config.php";

use PDO;

class Connection {
    public static function create() {
        $conString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $con = new PDO($conString, DB_USER, DB_PASS);
        return $con;
    }
}