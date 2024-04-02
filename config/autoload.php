<?php

spl_autoload_register(function ($class) {
    $baseDir = realpath(__DIR__ . '\\..\\src');
    $path = $baseDir . '\\' . $class . '.php';
    if(file_exists($path)) {
        require_once $path;
    }
});