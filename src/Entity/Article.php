<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length = 100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $date;

    //getters and setters
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getContent(){
        return $this->content;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getDate(){
        return $this->date;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setAuthor($author){
        $this->author = $author;
    }
    public function setDate($date){
        $this->date = $date;
    }
}
