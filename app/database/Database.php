<?php 

class Database extends Config {

    private static $connection;

    public static function openLink(){
        return self::$connection = new PDO(
            parent::getConfig()['.'],
            parent::getConfig()['..'],
            parent::getConfig()['...'],
        );
    }

    public static function closeLink(){
        return self::$connection = null;
    }

}

?>