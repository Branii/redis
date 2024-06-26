<?php 

class Model {

    public static function validateApiKey(string $ApiKey) {
        $sql = "SELECT apikey FROM apikeys_tbl WHERE apikey = ?";
        $res = (new Helper)->selectOne($sql,[$ApiKey]);
        return !empty($res) ? true : false;
    }

    public static function fetchFantanGame(string $gameAlias) : array{
        $sql = "SELECT * FROM employees LIMIT 10";
        $res = (new Helper)->selectAll($sql);
        return $res;
    }

}

?>