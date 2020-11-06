<?php
namespace App\BackOffice\Modules\News;

use Entity\Comment;
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
        $commentManager = $this->managers->getManagerOf('Comments');
        $newsID = $request->getGetData('id');
        $manager->deleteNews($newsID);
        $commentManager->deleteFromNews($newsID);
        $user = $this->app->getUser();
        $user->setFlash("La news {$newsID} a bien été supprimée.");
        $HTTPResponse = $this->app->getHTTPResponse();
        $HTTPResponse->redirectPage('.');
    }

    public function executeModifyComment(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('Comments');
        if($request->checkMethod() === 'POST') {
            $comment = new Comment([
                'news' => $request->getPostData('news'),
                'author' => $request->getPostData('pseudo'),
                'content' =>$request->getPostData('content'),
                'id' =>$request->getGetData('id'),
            ]);
        
            if($comment->isValid()) {
                $manager->saveComment($comment);
                $user = $this->app->getUser();
                $user->setFlash("Le commentaire #{$comment->getID()} a bien été modifié !");
                $HTTPResponse = $this->app->getHTTPResponse();
                $HTTPResponse->redirectPage("/news-{$request->getPostData('news')}.html");
            } else {
                $this->page->addVar('errors', $comment->getErrors());
            }
        
        } else {
            $comment = $manager->getComment($request->getGetData('id'));
        }
        $this->page->addVar('comment', $comment);
        $this->page->addVar('title', 'Modification d\un commentaire');
    }

    public function executeDeleteComment(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('Comments');
        $commentID = $request->getGetData('id');
        $manager->deleteComment($commentID);
        $user = $this->app->getUser();
        $user->setFlash("Le commentaire #{$commentID} a bien été supprimé.");
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