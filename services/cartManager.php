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

    private static function insertProductIntoCart($cartId, $productId, $quantity) {
        $sql = "INSERT INTO `cartsproducts` (`cartId`, `productId`, `quantity`) 
        VALUES ('$cartId', '$productId', '$quantity')";

        $insertProduct = PDOManager::execute($sql);

    }
}



?>