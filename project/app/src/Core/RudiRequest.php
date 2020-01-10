<?php


namespace RudiMVC\Core;

use Symfony\Component\HttpFoundation\Request;

class RudiRequest {
    /**
     * @return string
     */
    public static function getPathInfo():string {
        $request =  Request::createFromGlobals();
        return $request->getPathInfo();
    }
}