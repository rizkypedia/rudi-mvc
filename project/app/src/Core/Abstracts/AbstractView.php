<?php

namespace RudiMVC\Core\Abstracts;

abstract class AbstractView{
    public abstract function render(string $className, array $data);
}
