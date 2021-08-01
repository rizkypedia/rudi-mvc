<?php

namespace RudiMVC\Components;

class TestComponent {
    public function __construct()
    {
        
    }

    /**
     * @return int
     */
    public function sum(int $a, int $b){
        return $a + $b;
    }
}