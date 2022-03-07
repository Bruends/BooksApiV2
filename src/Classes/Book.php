<?php

namespace BookshelfApi\Classes;

class Book
{
    private $id;
    private $title;
    private $description;
    private $author;
    private $imgPath;

    public function __construct($title = null, $description = null, $author = null, $imgPath = null, $id = null){
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->imgPath = $imgPath;
        $this->id = $id;
    }

    public function assocArrayToBook($bookArray) {
        foreach ($bookArray as $key => $value ) {
            $this->__set($key, $value);
        }
    }

    public function __set($attribute, $value)
    {
        if(isset($value))
            $this->$attribute = $value;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }

}
