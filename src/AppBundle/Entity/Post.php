<?php


class Post
{

    private $id;
    private $name;
    private $content;
    private $author;
    private $dateCreate;
    private $dateUpdate;


    private $images;


    public function __construct()
    {
        $this->dateCreate = new DateTime();

    }






}