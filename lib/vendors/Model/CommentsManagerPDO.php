<?php
namespace Model;

use Entity\Comment;
use \PDO;

class CommentsManagerPDO extends CommentsManager {
    public function addComments(Comment $comment) {
        $request = $this->dao->prepare('INSERT INTO comments (id, news, author, content, date) VALUES(NULL, :news, :author, :content, NOW())');
        $request->bindValue(':news', $comment->getNews(), PDO::PARAM_INT);
        $request->bindValue(':author', $comment->getAuthor(), PDO::PARAM_STR);
        $request->bindValue(':content', $comment->getContent());
        $request->execute();
        $request->closeCursor();
    }

    public function getCommentsList($newsId) {
        $request = $this->dao->prepare('SELECT * FROM comments where news = :newsID');
        $request->bindValue(':newsID', $newsId, PDO::PARAM_INT);
        $request->execute();
        $commentsList = $request->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Comment::class);
        foreach($commentsList as $comment) {
            $comment->setDate(new \DateTime($comment->getDate()));
        }
        return $commentsList;
    }

    // methode à implémenter !
    public function modifyComments(Comment $comments)
    {
        return true;
    }

}

