<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/productType.php");

class ProductTypeManager {
    public static function getProductTypes() {

        $query = "SELECT * FROM `productTypes`";
        $productTypes = PDOManager::fetchAll($query);
        $allProductTypes = [];
        foreach($productTypes as $productType){
            $allProductTypes[]= 
            new ProductType(
            $productType["type"], 
            $productType["displayName"], 
            $productType["displayNamePlural"]
        );
        }
    
        return $allProductTypes;
    }
    
    public static function getProductTypeByName($name) {
    
        if($name === NULL) {
            return new ProductType(NULL, NULL, NULL);
        }
    
        $query = " SELECT * FROM `producttypes` Where type = '".$name."'";
        $result = PDOManager::fetch($query);
        $productType = new ProductType(
            $result["type"], 
            $result["displayName"], 
            $result["displayNamePlural"]
        );
    
        return $productType;
    }

}




?>