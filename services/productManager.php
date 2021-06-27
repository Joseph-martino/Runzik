<?php
require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."services/productTypeManager.php");
require_once(ROOT_PATH ."models/product.php");
require_once(ROOT_PATH ."models/products.php");

class ProductManager {
    public static function getProducts($productType, $selectedBrands = [], $sortDesc = false) { 

        $brandFilter = SELF::buildBrandsFilter($selectedBrands);
        $sort = $sortDesc ? "DESC" : "ASC";

        $query = "
        SELECT p.*, b.name brandName 
        FROM `products` p 
        INNER JOIN `brands` b ON p.brandId = b.id 
        INNER JOIN `producttypes` pt ON p.typeId = pt.id 
        WHERE 1 = 1 ".$brandFilter." 
        AND pt.type = '".$productType."'
        ORDER BY p.price ".$sort
        ;
        $products = PDOManager::fetchAll($query);
        $allProducts = [];
        foreach($products as $product){
            $allProducts[]= 
            new Product(
                $product["id"],
                $product["name"], 
                $product["price"], 
                $product["image"], 
                $product["colour1"], 
                $product["colour2"], 
                $product["brandName"]
            );
        }
    
        $type = ProductTypeManager::getProductTypeByName($productType);
    
        return new ProductList($type, $allProducts);
    }
 
    public static function buildBrandsFilter($selectedBrands) {
        $where = "";
        foreach($selectedBrands as $brand) {
            $where = $where."'".$brand."',"; 
        }
    
        if(strlen($where) > 0) {
            $where = rtrim($where,",");
            $where = "AND b.name IN (". $where . ")";
        }
        return $where;
    
    }
    
    public static function getProduct($productType, $id) {
          
        $query ="
        SELECT p.*, b.name brandName, pt.type 
        FROM `products` p 
        INNER JOIN `brands` b ON p.brandId = b.id 
        INNER JOIN `producttypes` pt ON p.typeId = pt.id 
        WHERE pt.type = '".$productType."' AND p.id = ".$id."
        ";
        $result = PDOManager::fetch($query);
        $product = new Product(
                $result["id"],
                $result["name"], 
                $result["price"], 
                $result["image"], 
                $result["colour1"], 
                $result["colour2"], 
                $result["brandName"]
            );
            
        $type = ProductTypeManager::getProductTypeByName($productType);
    
        return new ProductList($type, $product);
    }

}




?>