<?php
namespace Model;

use Entity\Comment;
use OCFram\Manager;

abstract class CommentsManager extends Manager {
    abstract public function addComments(Comment $comment);
    abstract public function modifyComments(Comment $comments);

    public function saveComment(Comment $comment){
        if($comment->isValid()) {
            $comment->isNew() ? $this->addComments($comment) : $this->modifyComment();
        }
        else {
            throw new \RuntimeException('Le commentaire doit être valide pour être enregistré (auteur & contenu)');
        }
    }

    abstract public function getCommentsList($newsID);
}