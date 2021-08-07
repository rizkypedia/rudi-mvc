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
        $controller = $className;

        if(!class_exists($controller)){
            throw new NotFoundException(sprintf('Non class found with name '. $className));
        }

        return  new $controller();        
        
    }

}