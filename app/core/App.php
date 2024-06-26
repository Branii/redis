<?php 

class App {

    public function render() : void {

        Flight::before('start', function() { // middleware v1
            $apiKey = apache_request_headers()['api_key'];
            if (empty($apiKey) || !(new Model)::validateApiKey($apiKey)) {
                Flight::json(['error' => 'Unauthorized'], 401);
                Flight::stop();
            }
        });
   
        Flight::route('/api/v1/fantan/@id', function($gameId) {
            try {
                $result = Redis::Cache()->get($gameId);
                $jsonData = $result ? json_decode($result, true) : (new Controller)::fetchGame($gameId);
                $result ?: Redis::Cache()->set($gameId, json_encode($jsonData[0]));
                Flight::json([[$jsonData]]);
            } catch (\Throwable $th) {
                (new Monolog)->error($th->getMessage());
            }
        });

        Flight::route('/api/v2/fantan/reset', function() {
            Redis::Cache()->flushdb();
            Flight::json(['Message' => 'Done!']);
        });

        Flight::start();
        
    }

 }
?>