<?php

spl_autoload_register(function ($class) {
    // Convertir le namespace en chemin de fichier
    $classPath = str_replace('\\', '/', $class) . '.php';
    
    // Chemins à vérifier dans l'ordre de priorité
    $paths = [
        __DIR__ . '/../models/',    // Pour App\Models\
        __DIR__ . '/../controllers/', // Pour App\Controllers\
        __DIR__ . '/../core/',      // Pour App\Core\
        __DIR__ . '/'               // Pour les classes sans namespace
    ];

    foreach ($paths as $basePath) {
        $fullPath = $basePath . $classPath;
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }
    
    // Gestion d'erreur améliorée
    throw new Exception("Classe introuvable : $class");
});