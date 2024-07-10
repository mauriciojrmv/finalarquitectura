<?php

spl_autoload_register(function ($class_name) {
    $directories = [
        __DIR__ . '/datos/',
        __DIR__ . '/negocio/',
        __DIR__ . '/presentacion/',
    ];

    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
