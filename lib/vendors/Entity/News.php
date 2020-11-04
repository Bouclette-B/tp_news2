<?php
namespace Entity;

class News extends Entity {
    protected $author;
    // protected $id;
    protected $title;
    protected $content;
    protected $creationDate;
    protected $updateDate = null;

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

    public function __construct(?array $data = null) {
        if(!empty($data)) {
            $this->hydrate($data);
        }
    }
    
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    public function isValide() : bool {
        return !(empty($this->author) || empty($this->title) || empty($this->content));
    }
    // public function __set($attribut, $value)
    // {
    //     $attribut = "_$attribut";
    //     if($attribut){
    //         $this->$attribut = $value;
    //     }
    // }

    // GETTERS

    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getUpdateDate() {
        return $this->updateDate;
    }

    // SETTERS

    // public function setId($id) {
    //     if (is_int($id)) {
    //         $this->id = $id;
    //     }
    // }

    public function setAuthor($author) {
        if (!is_string($author) || empty($author)) {
            $this->erreurs[] = self::INVALID_AUTHOR;
        }
        $this->author = $author;
    }

    public function setTitle($title) {
        if (!is_string($title) || empty($title)) {
            $this->erreurs[] = self::INVALID_TITLE;
        }
        $this->title = $title;
    }

    public function setContent($content) {
        if (!is_string($content) || empty($content)) {
            $this->erreurs[] = self::INVALID_CONTENT;
        }
        $this->title = $content;
    }

    public function setCreationDAte(\DateTime $creationDate) {
            $this->creationDate = $creationDate;
    }

    public function setUpdateDate(\DateTime $updateDate) {
            $this->updateDate = $updateDate;
    }

    public function getExcerpt(){
        if(strlen(strip_tags($this->getContent())) > 199) {
            $excerpt = substr($this->getContent(), 0, 199);
            $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')). ' ...';
        } else {
            $excerpt =  $this->getContent();
        }
        return nl2br($excerpt);
    }
}
