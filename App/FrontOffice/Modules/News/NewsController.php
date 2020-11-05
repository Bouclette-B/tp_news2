<?php
namespace App\FrontOffice\Modules\News;

use OCFram\BackController;
use OCFram\HTTPRequest;

class NewsController extends BackController {

    public function executeIndex(HTTPRequest $request) {
        //récupérer les infos du fichier de config
        $newsLimit = $this->app->getConfig()->getVar('news_limit');
        $excerptLimit = (int) $this->app->getConfig()->getVar('excerpt_limit');

        // ajoute une variable pour le titre
        $this->page->addVar('title', "Liste des {$newsLimit} dernières news");

        // récupère le manager
        $manager = $this->managers->getManagerOf('News');

        // récupère les 5 dernières news
        $newsList = $manager->getNewsList($newsLimit);

        //tronquer le contenu à 200 caractères
        foreach ($newsList as $news) {
            $newsLength = strlen(strip_tags($news->getContent()));
            if ($newsLength > $excerptLimit) {
                $newsExcerpt = substr($news->getContent(), 0, $excerptLimit);
                $newsExcerpt = substr($newsExcerpt, 0, strrpos($newsExcerpt, ' ')). '...';
                $news->setContent($newsExcerpt);
            }
        }

        // passer les news tronquées à la view
        $this->page->addVar('newsList', $newsList);
    }

    public function executeShow(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('News');
        $id = $request->isGetData('id');
        $news = $manager->getNews($id);
        
        if(empty($news)){
            $this->app->getHTTPResponse()->redirect404();
        } 

        $this->page->addVar('title', $news->getTitle());
        $this->page->addVar('news', $news);
    }
}

