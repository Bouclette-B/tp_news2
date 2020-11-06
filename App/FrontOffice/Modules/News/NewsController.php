<?php
namespace App\FrontOffice\Modules\News;

use Entity\Comment;
use OCFram\BackController;
use OCFram\HTTPRequest;

class NewsController extends BackController {

    public function executeIndex(HTTPRequest $request) {
        $newsLimit = $this->app->getConfig()->getVar('news_limit');
        $excerptLimit = (int) $this->app->getConfig()->getVar('excerpt_limit');

        $this->page->addVar('title', "Liste des {$newsLimit} dernières news");

        $manager = $this->managers->getManagerOf('News');

        $newsList = $manager->getNewsList($newsLimit);

        foreach ($newsList as $news) {
            $newsLength = strlen(strip_tags($news->getContent()));
            if ($newsLength > $excerptLimit) {
                $newsExcerpt = substr($news->getContent(), 0, $excerptLimit);
                $newsExcerpt = substr($newsExcerpt, 0, strrpos($newsExcerpt, ' ')). '...';
                $news->setContent($newsExcerpt);
            }
        }

        $this->page->addVar('newsList', $newsList);
    }

    public function executeShow(HTTPRequest $request) {
        $newsManager = $this->managers->getManagerOf('News');
        $id = $request->getGetData('id');
        $news = $newsManager->getNews($id);
        $user = $this->app->getUser();

        $commentsManager = $this->managers->getManagerOf('Comments');
        $comments = $commentsManager->getCommentsList($id);

        if(empty($news)){
            $this->app->getHTTPResponse()->redirect404();
        } 

        $this->page->addVar('title', $news->getTitle());
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $comments);
        $this->page->addVar('user', $user);
    }

    public function executeAddComment(HTTPRequest $request) {
        $pseudo = htmlspecialchars($request->isPostData('pseudo'));
        $newsID = $request->getGetData('newsID');
        if($pseudo) {
            $comment = new Comment([
                'news' => $newsID,
                'author' => $request->getPostData('pseudo'),
                'content' => $request->getPostData('content')
            ]);
        
        // vérification des données
            if($comment->isValid()){
                $manager = $this->managers->getManagerOf('Comments');
                $manager->saveComment($comment);
                $user = $this->app->getUser();
                $user->setFlash('Le commentaire a bien été ajouté, merci mon lapin !');
                $HTTPResponse = $this->app->getHTTPResponse();
                $HTTPResponse->redirectPage("news-{$newsID}.html");    
            } else {
                $this->page->addVar('errors', $comment->getErrors());
            }
        $this->page->addVar('title', 'Ajouter un commentaire');
        $this->page->addVar('comment', $comment);
        }
    }
}

