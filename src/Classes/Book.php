<?php

namespace BookshelfApi\Classes;

class Book 
{
    private $title;
    private $description;
    private $author;
    private $imgPath;

    public function __construct($title, $description, $author, $imgPath = null){
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->imgPath = $imgPath;
    }    
   
    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }

}