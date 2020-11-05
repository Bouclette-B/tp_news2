<?php
namespace App\BackOffice;

use App\BackOffice\Modules\Connexion\ConnexionController;
use OCFram\Application;

class BackOfficeApp extends Application {

    public function __construct() {
        parent::__construct();
        $this->name = 'BackOffice';
    }

    public function run() {
        if($this->user->isUserAuthenticated()) {
            $controller = $this->getController();
        } else {
            // en attente de la création du fichier ConnexionController !!
            $controller = new ConnexionController($this, 'Connexion', 'index');
        }

        $controller->execute();
        $this->HTTPResponse->setPage($controller->getPage());
        $this->HTTPResponse->sendResponse();
    }
}