<?php
namespace App\BackOffice\Modules\Connexion;

use OCFram\BackController;
use OCFram\HTTPRequest;

class ConnexionController extends BackController {
    public function executeIndex(HTTPRequest $request) {
        $this->page->addVar('title', 'Connexion');

        if($request->isPostData('login')) {
            $registeredLogin = $this->app->getConfig()->getVar('login');
            $registerdPassword = $this->app->getConfig()->getVar('passWord');
            $login = $request->getPostData('login');
            $passWord = $request->getPostData('password');
            $user = $this->app->getUser();
            
            if($registeredLogin == $login || $registerdPassword == $passWord) {
                $user->setUserAuthenticated(true);
                $this->app->getHTTPResponse()->redirectPage('.');
            } else {
                $user->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }
}