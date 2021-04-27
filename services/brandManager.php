<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/brand.php");

  
class BrandManager {
    public static function getBrands() {

        $query = "SELECT * FROM `brands`";
        $brands = PDOManager::fetchAll($query);
    
        // $pdo = myPDO::getPDO();
        // $statement= $pdo->prepare("SELECT * FROM `brands`");
        // $statement->execute();
        // $brands = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $allBrands = [];
        foreach($brands as $brand){
            $allBrands[] = new Brand($brand["name"]);
        }
        return $allBrands;
    }

}



?>