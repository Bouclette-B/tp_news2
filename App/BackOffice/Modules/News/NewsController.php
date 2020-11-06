<?php
namespace App\BackOffice\Modules\News;

use Entity\News;
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

    public function executeAddNews(HTTPRequest $request) {
        if($request->isPostData('author')) {
            $this->checkForm($request);
        }
        $this->page->addVar('title', 'Ajout d\'une news');
    }

    public function executeUpdateNews(HTTPRequest $request) {
        if($request->isPostData('author')) {
            $this->checkForm($request);
        } else {
            $manager = $this->managers->getManagerOf('News');
            $news = $manager->getNews($request->getGetData('id'));
            $this->page->addVar('news', $news);
        }
        $this->page->addVar('title', 'Modification d\'une news');
    }

    public function executeDeleteNews(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('News');
        $newsID = $request->getGetData('id');
        $manager->deleteNews($newsID);
        $user = $this->app->getUser();
        $user->setFlash("La news {$newsID} a bien été supprimée.");
        $HTTPResponse = $this->app->getHTTPResponse();
        $HTTPResponse->redirectPage('.');
    }

    public function checkForm(HTTPRequest $request) {
        $news = new News([
            'author' => $request->getPostData('author'),
            'title' => $request->getPostData('title'),
            'content' => $request->getPostData('content')
        ]);

        if($request->isPostData('id')) {
            $news->setID($request->getPostData('id'));
        }

        if($news->isValid()) {
            $manager = $this->managers->getManagerOf('News');
            $manager->saveNews($news);
            $user = $this->app->getUser();
            $user->setFlash($news->isNew() ? 'Votre news a bien été ajoutée !' : "La news #{$news->getID()} a bien été modifiée !");
        } else {
            $this->page->addVar('errors', $news->getErrors());
        }

        $this->page->addVar('news', $news);
    }
    
}