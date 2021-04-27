<?php

require_once(ROOT_PATH ."services/pdo.php");

class PDOManager {
    
    public static function fetchAll($query) {        
        $pdo = myPDO::getPDO();
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($query) {        
        $pdo = myPDO::getPDO();
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

?>