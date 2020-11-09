<?php
namespace Model;

use Entity\Comment;
use \PDO;
use \DateTime;

class CommentsManagerPDO extends CommentsManager {
    public function addComment(Comment $comment) {
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
            $comment->setDate(new DateTime($comment->getDate()));
        }
        return $commentsList;
    }

    public function modifyComment(Comment $comment) {
        $request = $this->dao->prepare('UPDATE comments SET author = :author, content = :content WHERE id= :id');
        $request->bindValue(':author', $comment->getAuthor());
        $request->bindValue(':content', $comment->getContent());
        $request->bindValue(':id', $comment->getID(), PDO::PARAM_INT);
        $request->execute();
    }

    public function getComment($id) {
        $request = $this->dao->prepare('SELECT * FROM comments WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute();
        $comment = $request->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Comment::class);
        $comment = $comment[0];
        $comment->setDate(new DateTime($comment->getDate()));
        return $comment;
    }

    public function deleteComment($id) {
        $this->dao->query("DELETE FROM comments WHERE id =" . (int)$id);
    }

    public function deleteFromNews($newsID) {
        $this->dao->query("DELETE FROM comments WHERE id =" . (int)$newsID);
    }
    
}


