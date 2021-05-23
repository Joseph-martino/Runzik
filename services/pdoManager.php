<?php

require_once(ROOT_PATH ."services/pdo.php");

class PDOManager {
    
    public static function fetchAll($query, $parameters = null) {        
        $pdo = myPDO::getPDO();
        $statement = $pdo->prepare($query);
        if ($parameters !== null) {
            foreach($parameters as $parameter){
                $statement->bindValue($parameter["name"], $parameter["value"], $parameter["type"]);
            }
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($query, $parameters = null) {        
        $pdo = myPDO::getPDO();
        $statement = $pdo->prepare($query);
        if ($parameters !== null) {
            foreach($parameters as $parameter){
                $statement->bindValue($parameter["name"], $parameter["value"], $parameter["type"]);
            }
        }
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function execute($sql, $parameters = null) {
        $pdo = myPDO::getPDO();             
        $query = $pdo->prepare($sql);
        SELF::bindValues($query, $parameters);
        $query->execute();

        return $pdo->lastInsertId();
    }

    private static function bindValues($query, $parameters) {
        if ($parameters !== null) {
            foreach($parameters as $parameter){
                $query->bindValue($parameter["name"], $parameter["value"], $parameter["type"]);
            }
        }
    }
}

?>