<?php 
spl_autoload_register(function ($class){
    $dirs = [
        'app',
        'app/core', 
        'app/config', 
        'app/controller',
        'app/config',
        'app/database',
        'app/model',
        'app/exception',
        'vendor'
    ];
    foreach ($dirs as $dir) {
        $filename = $dir . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($filename)) {
            include $filename;
            return;
        }
    }
});