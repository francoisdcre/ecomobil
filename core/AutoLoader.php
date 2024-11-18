<?php
spl_autoload_register(function ($class) {
    // Remplacer les antislashs par des slashs
    $class = str_replace('\\', '/', $class);

    // Chemin vers les fichiers de classes
    $paths = [
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/models/',
        __DIR__ . '/../app/views/',
        __DIR__ . '/../core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Si la classe n'a pas été trouvée
    throw new Exception("Unable to load class: $class");
});
