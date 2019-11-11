<?php

namespace RudiMVC\Core;

use RudiMVC\Core\Factories\ControllerFactory;
use RudiMVC\Views\ViewMain;

class RudiApp {

    public static function init() {

        $uri = $_SERVER['PATH_INFO'];

        if (!empty($uri) && strlen($uri) > 1) {
            $requestSplitter = RequestSplitter::getInstance();
            $requestParameter = $requestSplitter->split_request($uri);

            $controller = ControllerFactory::create(new RudiView(), $requestParameter['controller']);
            call_user_func_array(array($controller, $requestParameter['action']), $requestParameter['parameters']);
        }
    }

}
