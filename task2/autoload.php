<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/app/';

    $relativeClass = preg_replace('/^App\\\\/', '', $class);

    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
