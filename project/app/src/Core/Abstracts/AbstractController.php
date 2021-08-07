<?php

namespace RudiMVC\Core\Abstracts;

abstract class AbstractController {
    abstract protected function info();
    protected function tojson(array $data):string
    {
        return json_encode($data);
    }
}