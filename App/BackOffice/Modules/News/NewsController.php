<?php
namespace App\BackOffice\Modules\News;

use Entity\Comment;
use Entity\News;
use FormBuilder\CommentFormBuilder;
use FormBuilder\NewsFormBuilder;
use OCFram\BackController;
use OCFram\FormHandler;
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
        $this->checkForm($request);
        $this->page->addVar('title', 'Ajout d\'une news');
    }

    public function executeUpdateNews(HTTPRequest $request) {
        $this->checkForm($request);
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
        $this->page->addVar('title', 'Modification d\un commentaire');
        if($request->checkMethod() === 'POST') {
            $comment = new Comment([
                'news' => $request->getPostData('news'),
                'author' => $request->getPostData('pseudo'),
                'content' =>$request->getPostData('content'),
                'id' =>$request->getGetData('id'),
                ]);
            } else {
                $comment = $manager->getComment($request->getGetData('id'));
            }
            
            $formbuilder = new CommentFormBuilder($comment);
            $formbuilder->build();
            
            $form = $formbuilder->getForm();
            $formHandler = new FormHandler($form, $manager, $request);
            
        if($formHandler->processForm($form)) {
            $manager->save($comment);
            $user = $this->app->getUser();
            $user->setFlash("Le commentaire #{$comment->getID()} a bien été modifié !");
            $HTTPResponse = $this->app->getHTTPResponse();
            $HTTPResponse->redirectPage("/news-{$request->getPostData('news')}.html");
        } 
        
        $this->page->addVar('comment', $comment);
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
        $manager = $this->managers->getManagerOf('News');
        if($request->checkMethod() === 'POST') {
            $news = new News([
                'author' => $request->getPostData('author'),
                'title' => $request->getPostData('title'),
                'content' => $request->getPostData('content')
            ]);

            if($request->isGetData('id')) {
                $news->setID($request->getGetData('id'));        
            }
            
        } else {
            if($request->isGetData('id')) {
                $manager->getNews($request->getGetData('id'));
            } else {
                $news = new News();
            }
        }

        $formbuilder = new NewsFormBuilder($news);
        $formbuilder->build();
        $form = $formbuilder->getForm();

        if($request->checkMethod() === 'POST' && $form->isValid()) {
            $manager = $this->managers->getManagerOf('News');
            $manager->save($news);
            $user = $this->app->getUser();
            $user->setFlash($news->isNew() ? 'Votre news a bien été ajoutée !' : "La news #{$news->getID()} a bien été modifiée !");
        } else {
            $this->page->addVar('errors', $news->getErrors());
        }

        $this->page->addVar('form', $form->createView());
    }
    
}