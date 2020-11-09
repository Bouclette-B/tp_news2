<?php
namespace Model;

use Entity\Comment;
use OCFram\Manager;

abstract class CommentsManager extends Manager {
    abstract public function addComment(Comment $comment);
    abstract public function modifyComment(Comment $comments);

    public function save(Comment $comment){
        if($comment->isValid()) {
            $comment->isNew() ? $this->addComment($comment) : $this->modifyComment($comment);
        }
        else {
            throw new \RuntimeException('Le commentaire doit être valide pour être enregistré (auteur & contenu)');
        }
    }

    abstract public function getCommentsList($newsID);
    abstract public function getComment($id);
    abstract public function deleteComment($id);
    abstract public function deleteFromNews($newsID);
}