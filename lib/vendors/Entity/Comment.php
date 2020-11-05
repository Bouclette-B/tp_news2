<?php
namespace Entity;

use OCFram\Entity;

class Comment extends Entity {
    protected $news;
    protected $author;
    protected $content;
    protected $date;

    const INVALID_AUTHOR = 1;
    const INVALID_CONTENT = 2;

    public function isValid() {
        return !(empty($this->author) || empty($this->content));
    }

    // SETTERS
    public function setNews($news) {
        $this->news = (int)$news;
    }

    public function setAuthor(string $author) {
        if(!is_string($author) || empty($author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        }
        $this->author = $author;
    }

    public function setContent($content) {
        if(!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_CONTENT;
        }
        $this->content = $content;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    // GETTERS
    public function getNews() {
        return $this->news;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getContent() {
        return $this->content;
    }
     public function getDate() {
        return $this->date;
     }
}