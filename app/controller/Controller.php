<?php 
declare(strict_types=1);
    class Controller extends Model{
       
        public static function fetchGame(string $gameId){
            return [
                '5d'    => (new GameMap)::FiveD_games($gameId),
                '3d'    => (new GameMap)::ThreeD_games($gameId),
                'fast3' => (new GameMap)::Fast3_games($gameId),
                'pk10'  => (new GameMap)::Pk10_games($gameId),
                'hpp8'  => (new GameMap)::Happy8_games($gameId),
                '11x5'  => (new GameMap)::Eleven5_games($gameId)
            ][$gameId] ?? ['Messsage'=>"Page not found"];
        }
    }

?>