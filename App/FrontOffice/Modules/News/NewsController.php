<?php
namespace App\FrontOffice\Modules\News;

use OCFram\BackController;
use OCFram\HTTPRequest;

class NewsController extends BackController {

    public function executeIndex(HTTPRequest $request) {
        //récupérer les infos du fichier de config
        $newsLimit = $this->app->getConfig()->getVar('news_limit');
        $excerptLimit = $this->app->getConfig()->getVar('excerpt_limit');

        // ajoute une variable pour le titre
        $this->page->addVar('title', "Liste des {$newsLimit} dernières news");

        // récupère le manager
        $manager = $this->managers->getManagerOf('News');

        // récupère les 5 dernières news
        
        $newsList = $manager->getNewsList($newsLimit);

        //tronquer le contenu à 200 caractères
        foreach ($newsList as $news) {
            $newsLength = strlen($news['content']);
            if ($newsLength > $excerptLimit) {
                $newsExcerpt = wordwrap($news['content'], ($excerptLimit - 1));
                $newsExcerpt = explode("\\n", $newsExcerpt);
                $news['content'] = $newsExcerpt[0] . "...";
            }
        }

        // passer les news tronquées à la view
        $this->page->addVar('newsList', $newsList);
    }
}

// $db = DBFactory::getMysqlConnectionWithPDO();
// $newsManagerPDO = new NewsManagerPDO($db);
// $newsList = $newsManagerPDO->getNewsList('LIMIT 5');
// $viewData = [
//     'newsList' => $newsList,
// ];
// $this->render('homeView', $viewData);
