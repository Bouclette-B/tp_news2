<?php
namespace Model;
use Entity\News;
use OCFram\Manager;

abstract class NewsManager extends Manager {
    abstract public function addNews(News $news);
    abstract public function updateNews(News $news);
    public function saveNews(News $news) {
        if($news->isValid()) {
            $news->isNew() ? $this->addNews($news) : $this->updateNews($news);
        } else {
            throw new \RuntimeException('La news doit être validée pour être enregistrée');
        }
    }
    abstract public function deleteNews($id);
    abstract public function getNewsList($limit = null);
    abstract public function count();
}