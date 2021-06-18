<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/brand.php");

  
class BrandManager {
    public static function getBrands() {

        $query = "SELECT * FROM `brands`";
        $brands = PDOManager::fetchAll($query);
        $allBrands = [];
        foreach($brands as $brand){
            $allBrands[] = new Brand($brand["name"]);
        }
        return $allBrands;
    }

}



?>