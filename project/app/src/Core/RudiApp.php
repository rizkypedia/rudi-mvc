<?php

namespace RudiMVC\Core;

use RudiMVC\Core\Factories\ControllerFactory;
use RudiMVC\Views\ViewMain;
use Symfony\Component\HttpFoundation\Request;

class RudiApp {

    public static function init() {

        $request = Request::createFromGlobals();
        $uri = $request->getPathInfo();

        if (!empty($uri) && strlen($uri) > 1) {
            $requestSplitter = RequestSplitter::getInstance();
            $requestParameter = $requestSplitter->split_request($uri);

            $controller = ControllerFactory::create(new RudiView(), $requestParameter['controller']);
            call_user_func_array(array($controller, $requestParameter['action']), $requestParameter['parameters']);
        }
    }

}
