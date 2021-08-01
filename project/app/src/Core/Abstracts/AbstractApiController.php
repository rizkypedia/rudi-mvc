<?php

namespace RudiMVC\Core\Abstracts;

abstract class AbstractApiController {
    protected function tojson($data):string
    {
        return json_encode($data);
    }
}