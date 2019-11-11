<?php

namespace RudiMVC\Core\Factories;

use RudiMVC\Core\Abstracts\AbstractController;
use RudiMVC\Core\Abstracts\AbstractView;

class ControllerFactory {

    /**
     * @param \RudiMVC\Core\Factories\AbstractView $view
     * @param string $className
     * @param string $namespace
     * @return AbstractController
     */
    public static function create(AbstractView $view, string $className, string $namespace = DEFAULT_NAMESPACE):AbstractController {
        $class = $namespace . "\\Controller\\" . $className . "Controller";
        $instance = new $class($view);
        return $instance;
    }

}