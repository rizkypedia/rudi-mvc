<?php


namespace RudiMVC\Core;


class RudiRequest {

    /**
     * @param string $serverKey
     * @return string|null
     */
    public static function getServerVariable(string $serverKey):?string {
        return $_SERVER[$serverKey];
    }

}