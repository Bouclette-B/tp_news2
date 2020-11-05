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

    public function deleteNews(News $news) {
        $this->dao->query("DELETE FROM news WHERE id =" . $news->getId());
    }

    public function updateNews(array $news) {
        $request = $this->dao->prepare('UPDATE news SET author = :author, title = :title, content = :content, updateDate = NOW() WHERE id=' .$news['id']);
        $request->bindValue(':author', $news['author']);
        $request->bindValue(':title', $news['title']);
        $request->bindValue(':content', $news['content']);
        $request->execute();
    }

    public function getNewsList(int $limit) {
        $request = $this->dao->prepare('SELECT * FROM news ORDER BY id DESC LIMIT :limit');
        $request->bindValue(':limit', $limit, PDO::PARAM_INT);
        $request->execute();
        $newsList = $request->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, News::class);
        foreach($newsList as $news) {
            $news->setCreationDate(new DateTime($news->getCreationDate()));
            if($news->getUpdateDate()) {
                $news->setUpdateDate(new DateTime($news->getUpdateDate()));
            }
        }
        return $newsList;
    }

    public function getNews($id)
    {
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


}