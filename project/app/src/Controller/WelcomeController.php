<?php


namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiContainer;
use RudiMVC\Core\RudiController;

class WelcomeController extends RudiController {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction() {
        $data['message'] = 'Welcome to Rudi MVC DONG DONG';
        
        $this->view->render(__METHOD__, $data);
    } 
    
  
}