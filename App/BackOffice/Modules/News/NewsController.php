<?php
namespace App\BackOffice\Modules\News;

use OCFram\BackController;
use OCFram\HTTPRequest;

class NewsController extends BackController {
    
    public function executeIndex(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('News');
        $newsList = $manager->getNewsList();

        $this->page->addVar('newsList', $newsList);
        $this->page->addVar('newsCount', $manager->count());
        $this->page->addVar('title', 'Gestion des news');
    }
}