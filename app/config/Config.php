<?php 

class Config {

    private static $config = [
        '.' => 'mysql:host=localhost;dbname=batch',
        '..' => 'root',
        '...' => 'root',
    ];

    public static function getConfig() {
        return self::$config;
    }

}

?>