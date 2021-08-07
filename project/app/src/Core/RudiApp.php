<?php

namespace RudiMVC\Core;

use DI\NotFoundException;
use RudiMVC\Components\TestComponent;
use RudiMVC\Core\Abstracts\AbstractController;
use RudiMVC\Core\Factories\ControllerFactory;
use RudiMVC\Views\ViewMain;
use Symfony\Component\HttpFoundation\Request;
use RudiMVC\Core\RudiContainer;

class RudiApp {

    public static function boot(){
       RudiContainer::set('RudiView', new RudiView());
    }
    /**
     * @throws NotFoundException
     * @throws \Exception
     */
    public static function route() {

        $request = Request::createFromGlobals();
        $uri = $request->getPathInfo();

        if (!empty($uri) && strlen($uri) > 1) {
            $requestSplitter = RequestSplitter::getInstance();
            $requestParameter = $requestSplitter->split_request($uri);
            $className = DEFAULT_NAMESPACE . "\\" . CONTROLLER_SUFFIX . "\\" . $requestParameter['controller'] . CONTROLLER_SUFFIX;
          
            if($requestParameter['api'] === true){
                $className = DEFAULT_NAMESPACE . "\\" . CONTROLLER_SUFFIX . "\\" . "Api" ."\\" . $requestParameter['controller'] ."Api" . CONTROLLER_SUFFIX;
            }
            $controller = ControllerFactory::create($className);
           
            return call_user_func_array(array($controller, $requestParameter['action']), $requestParameter['parameters']);
        }
    }

}
