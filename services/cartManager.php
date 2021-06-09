<?php

require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH . "models/product.php");
require_once(ROOT_PATH . "models/cartProduct.php");

class CartManager {
    
    public static function addProductToCart($cartId, $productId, $quantity) {
        $result = SELF::getCartProductQuantity($cartId, $productId);
        if(!$result) {
            SELF::insertProductIntoCart($cartId, $productId, $quantity);
        } else {
            $quantityFromDB = $result["quantity"];
            $totalQuantity = $quantity + $quantityFromDB;
            SELF::updateProductQuantity($cartId, $productId, $totalQuantity);    
        }
    }

    public static function getCartProducts($cartId) {
        $sql = "SELECT p.*, cp.cartId, cp.quantity, b.name brandName 
        FROM `products` p 
        INNER JOIN `cartsproducts` cp ON p.id = cp.productId 
        INNER JOIN `brands` b ON p.brandId = b.id
        WHERE cp.cartId = ".$cartId."";

        $cartProducts = PDOManager::fetchAll($sql);
        $allCartProducts = [];
        foreach($cartProducts as $cartProduct) {
            $product = new Product(
                $cartProduct["id"],
                $cartProduct["name"], 
                $cartProduct["price"], 
                $cartProduct["image"], 
                $cartProduct["colour1"], 
                $cartProduct["colour2"], 
                $cartProduct["brandName"]
            );
            $allCartProducts[]= 
            new CartProduct($product, $cartProduct["quantity"]);
        }
        return $allCartProducts;
    }

    public static function deleteProductFromCart($cartId, $productId) {
        $sql = "DELETE FROM `cartsproducts` WHERE cartId = ".$cartId." AND productId = ".$productId."";
        $result = PDOManager::execute($sql);
    }

    public static function deleteAllProductsFromCart($cartId){
        $sql = "DELETE FROM `cartsproducts` WHERE cartId = ".$cartId."";
        PDOManager::execute($sql);
    }

    public static function updateProductQuantityFromCart($cartId, $productId, $quantity) {
        $sql = "UPDATE `cartsproducts` SET quantity = ".$quantity."
        WHERE cartId = '".$cartId."' AND productId = '".$productId."'";
        $updateProductQuantity = PDOManager::execute($sql); 

        SELF::deleteFromDBIfQuantityIsNull($cartId, $productId);
    }

    public static function calculateShippingCost($price) {
        
        if( $price >=0 && $price <1) {
            return 0;
        } else if ($price >300 && $price <= 600) {
            return 30;

        } else if( $price >600 && $price <= 900){
            return 20;
        } else if($price >900) {
            return 10;
        }
    }

   
    private static function getCartProductQuantity($cartId, $productId) {
        $sql = "SELECT quantity FROM `cartsproducts` WHERE cartId = ".$cartId." AND productId = ".$productId."";
        $result = PDOManager::fetch($sql);
        return $result;
    }

    private static function updateProductQuantity($cartId, $productId, $quantity) {
        $sql = "UPDATE `cartsproducts` SET quantity = ".$quantity."
        WHERE cartId = '".$cartId."' AND productId = '".$productId."'";
        $updateProductQuantity = PDOManager::execute($sql);
    }

    private static function deleteFromDBIfQuantityIsNull($cartId, $productId) {
        $sql = "DELETE FROM `cartsproducts` WHERE cartId = '".$cartId."' AND productId = '".$productId."' AND quantity = 0";
        $result = PDOManager::execute($sql);
    }

    private static function insertProductIntoCart($cartId, $productId, $quantity) {
        $sql = "INSERT INTO `cartsproducts` (`cartId`, `productId`, `quantity`) 
        VALUES ('$cartId', '$productId', '$quantity')";

        $insertProduct = PDOManager::execute($sql);
    }


}



?>