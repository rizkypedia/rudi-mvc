<?php

namespace RudiMVC\Core;

use RudiMVC\Core\Abstracts\AbstractController;
use RudiMVC\Core\Abstracts\AbstractView;

class RudiController extends AbstractController {

    protected $view;
    protected function info() {
    }

    public function __construct(AbstractView $view) {
        $this->view = $view;
    }

}