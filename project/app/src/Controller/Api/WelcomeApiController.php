<?php

namespace RudiMVC\Controller\Api;

use RudiMVC\Core\RudiApiController;
use RudiMVC\Core\RudiController;

class WelcomeApiController extends RudiApiController {

    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction(){
        $array = ["name" => "Barry Allen", "Superheroname" =>"The Flash"];
        echo $this->tojson($array);
    }

}