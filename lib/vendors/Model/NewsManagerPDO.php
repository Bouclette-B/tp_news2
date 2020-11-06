<?php
namespace Model;
use \PDO;
use Entity\News;
use \DateTime;

class NewsManagerPDO extends NewsManager {

    public function addNews(News $news) {
        $request = $this->dao->prepare('INSERT INTO news (author, title, content, creationDate) VALUES (:author, :title, :content, NOW())');
        $request->bindValue(':author', $news->getAuthor());
        $request->bindValue(':title', $news->getTitle());
        $request->bindValue(':content', $news->getContent());
        $request->execute();
    }

    public function deleteNews($id) {
        $this->dao->query("DELETE FROM news WHERE id =" . (int)$id);
    }

    public function updateNews(News $news) {
        $request = $this->dao->prepare('UPDATE news SET author = :author, title = :title, content = :content, updateDate = NOW() WHERE id= :id');
        $request->bindValue(':author', $news->getAuthor());
        $request->bindValue(':title', $news->getTitle());
        $request->bindValue(':content', $news->getContent());
        $request->bindValue(':id', $news->getID(PDO::PARAM_INT));
        $request->execute();
    }

    public function getNewsList($limit = null) {
        $request = $this->dao->query('SELECT * FROM news ORDER BY id DESC ' . $limit);
        $newsList = $request->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, News::class);
        foreach($newsList as $news) {
            $news->setCreationDate(new DateTime($news->getCreationDate()));
            if($news->getUpdateDate()) {
                $news->setUpdateDate(new DateTime($news->getUpdateDate()));
            }
        }
        return $newsList;
    }

    public function getNews($id) {
        $request = $this->dao->prepare('SELECT * FROM news WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute();
        $news = $request->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, News::class);
        $news = $news[0];
        $news->setCreationDate(new DateTime($news->getCreationDate()));
        if($news->getUpdateDate())
        {
            $news->setUpdateDate(new DateTime($news->getUpdateDate()));
        }

        return $news;
    }

    public function count() {
        return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }
}