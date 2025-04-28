<?php

spl_autoload_register(function ($class) {
    
    $classPath = __DIR__ . "/$class.php";
    if (file_exists($classPath)) {
        require_once $classPath;
    } else {
        $classPath = __DIR__ . '/../models/' . $class . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
        } else {
        $classPath = __DIR__ . '/../core/' . $class . '.php';  // Vérification dans le répertoire "core"
        if (file_exists($classPath)) {
            require_once $classPath;
        }
        }
    }
});