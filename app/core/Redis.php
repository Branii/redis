<?php 

 class Redis{

    private static $client;
    public static function Cache(){
        try {
            Predis\Autoloader::register();
            self::$client = new Predis\Client();
            return self::$client;
        } catch (\Throwable $e) {
            echo json_encode($e->getMessage());
        }
    }

 }

?>