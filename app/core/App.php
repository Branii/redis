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
                $arrKeys = ['5d','3d','fast4','pk10','hpp8','11x5'];
                if(!in_array($gameId,$arrKeys)){
                    Flight::json(['message' => 'Resource not found'], 404);
                }else{
                    $result = Redis::Cache()->get($gameId);
                    $jsonData = $result ? json_decode($result, true) : (new Controller)->fetchGame($gameId);
                    $result ?: Redis::Cache()->set($gameId, json_encode($jsonData[0]));
                    Flight::json([[$jsonData]]);
                }
                
            } catch (\Throwable $th) {
                $throwable = ['message' =>$th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'code' => $th->getCode(),
                'trace' => $th->getTrace()];
                (new Monolog)->error(json_encode($throwable));
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