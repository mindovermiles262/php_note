<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     *  @ORM\Column(type="text", length=100)
     */
    private $title;

    public function getTitle() {
        return $this->title;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    /**
     *  @ORM\Column(type="text")
     */
    private $body;
    
    public function getBody() {
        return $this->body;
    }
    
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * @ORM\Column(type="text", length=150)
     */
    private $author;

    public function getAuthor() {
        return $this->author;
    }
    
    public function setAuthor($author) {
        $this->author = $author;
    }
}
