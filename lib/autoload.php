<?php

spl_autoload_register(
    function (string $class)
    {
        if (0 === strpos($class, 'Multiexception\\')) {
            $path = substr($class, 15);
            require_once __DIR__ . '/' . str_replace('\\', '/', $path) . '.php';
        }
    }
);