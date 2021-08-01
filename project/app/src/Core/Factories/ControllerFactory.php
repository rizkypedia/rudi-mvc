<?php

namespace RudiMVC\Core\Factories;

use RudiMVC\Core\Exceptions\NotFoundException;
use RudiMVC\Core\Abstracts\AbstractController;
use RudiMVC\Core\Abstracts\AbstractView;

class ControllerFactory {

    /**
     * @param AbstractView $view
     * @param string $className
     * @return AbstractController
     */
    public static function create(string $className):AbstractController {
        $controller = DEFAULT_NAMESPACE . "\\" . CONTROLLER_SUFFIX . "\\" . $className . CONTROLLER_SUFFIX;

        if(!class_exists($controller)){
            throw new NotFoundException(sprintf('Non class found with name '. $controller));
        }

        return  new $controller();        
        
    }

}