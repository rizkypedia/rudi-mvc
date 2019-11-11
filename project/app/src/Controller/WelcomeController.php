<?php


namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;

class WelcomeController extends RudiController {

    public function __construct(AbstractView $view) {
        parent::__construct($view);
    }

    public function indexAction() {
        $data['message'] = 'Welcome to Rudi MVC';
        $this->view->render(__METHOD__, $data);
    }
}