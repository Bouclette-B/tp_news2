<?php
namespace App\FrontOffice;

use \OCFram\Application;

class FrontOfficeApp extends Application{
    public function __construct($app)
    {
        parent::__construct($app);
        $this->name = 'FrontOffice';
    }

    public function run(){
        $controller = $this->getController();
        $controller->execute();
        $this->HTTPResponse->setPage($controller->getPage());
        $this->HTTPResponse->sendResponse();
    }

}