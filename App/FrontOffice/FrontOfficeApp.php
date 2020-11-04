<?php
namespace App\FrontOffice;

use \OCFram\Application;

class FrontOfficeApp extends Application{
    public function __construct()
    {
        parent::__construct();
        $this->name = 'FrontOffice';
    }

    public function run(){
        $controller = $this->getController();
        $controller->execute();
        $this->HTTPResponse->setPage($controller->getPage());
        $this->HTTPResponse->sendResponse();
    }

}