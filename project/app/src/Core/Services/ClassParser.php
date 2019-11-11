<?php


namespace RudiMVC\Core\Services;


class classParser {

    public function __construct() {

    }

    /**
     *
     * @param string $className
     * @return array
     */
    public function extractClassAndMethod(string $className): array {
        $classparts = explode("::", $className);
        $controllerParts = explode("\\", $classparts[0]);
        $controllerName = str_replace(CONTROLLER_SUFFIX, "", end($controllerParts));
        $actionName = str_replace(ACTION_SUFFIX, "", $classparts[1]);
        return ['controller' => $controllerName, 'action' => strtolower($actionName)];
    }
}