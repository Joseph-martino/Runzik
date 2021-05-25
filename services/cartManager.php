<?php

require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."services/pdoManager.php");

class CartManager {
    
// à corriger et terminer
    public static function addProductToCart($cartId, $productId, $quantity) {
        $pdo = myPDO::getPDO();
        $sql = "INSERT INTO `cartsproducts` (`cartId`, `productId`, `quantity`) 
        VALUES ('$cartId', '$productId', '$quantity')";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        var_dump($statement);
    }

    public static function getProductTest($id) {
        // $sql = "SELECT * FROM products WHERE id = '".$id."'";
        $sql = "SELECT p.*, b.name brandName
        FROM `products` p 
        INNER JOIN `brands` b ON p.brandId = b.id
        WHERE p.id = '".$id."'";
        
        $result = PDOManager::fetch($sql);
        // $allProducts = [];
        $product= new Product(
            $result["id"],
            $result["name"], 
            $result["price"], 
            $result["image"], 
            $result["colour1"], 
            $result["colour2"], 
            $result["brandName"]
        );

        return $product;

    }

}



?>