<?php

namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;


class HomeController extends RudiController {

    public function __construct(AbstractView $view)
    {
        parent::__construct($view);
    }

    public function indexAction() {
        $data['message'] = 'This is an Index Page of Home Controller';
        $this->view->render(__METHOD__, $data);
    }

    public function printAction() {
        $data = ['hello' => 'Hallo Welt'];
        $this->view->render(__METHOD__, $data);
    }

    protected function info()
    {

    }
}