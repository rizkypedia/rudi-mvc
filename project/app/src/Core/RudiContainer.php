<?php

namespace RudiMVC\Core;

use RudiMVC\Core\Exceptions\NotFoundException;

class RudiContainer {
    protected static array $registry = [];
    /**
     * Bind a new key/value into the container.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        if (!array_key_exists($key, static::$registry)) {
            static::$registry[$key] = $value;
        }
    }

    /**
     * Retrieve a value from the registry.
     *
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new NotFoundException(sprintf('%s is not found in the Rudi Container.', $key));
        }

        return static::$registry[$key];
    }    
}