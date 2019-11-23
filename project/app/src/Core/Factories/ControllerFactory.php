<?php

namespace RudiMVC\Core\Factories;

use RudiMVC\Core\Abstracts\AbstractController;
use RudiMVC\Core\Abstracts\AbstractView;

class ControllerFactory {

    /**
     * @param AbstractView $view
     * @param string $className
     * @return AbstractController
     */
    public static function create(AbstractView $view, string $className):AbstractController {
        $class = DEFAULT_NAMESPACE . "\\" . CONTROLLER_SUFFIX . "\\" . $className . CONTROLLER_SUFFIX;
        $instance = new $class($view);
        return $instance;
    }

}