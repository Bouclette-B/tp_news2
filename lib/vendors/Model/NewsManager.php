<?php
namespace Model;
use Entity\News;
use OCFram\Manager;

abstract class NewsManager extends Manager {
    abstract public function addNews(News $news);
    abstract public function deleteNews(News $news);
    abstract public function updateNews(array $news);
    abstract public function getNewsList(int $limit);
}