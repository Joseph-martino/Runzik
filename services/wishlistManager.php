<?php

require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH . "models/product.php");
require_once(ROOT_PATH . "models/wishlist.php");
require_once(ROOT_PATH . "models/wishlistProduct.php");

class WishListManager {
    public static function toggleProductIntoWishlist($wishlistId, $productId) {
        $result = SELF::isProductIsInWishlist($wishlistId, $productId);
        if($result["isproduct"] > 0){
            SELF::removeProductToWishlist($wishlistId, $productId);
        } else {
            SELF::addProductToWishlist($wishlistId, $productId);
        }
    }

    private static function isProductIsInWishlist($wishlistId, $productId) {
        $sql = "SELECT COUNT(productId) isproduct FROM `wishlistproducts` wp
        WHERE wp.wishlistId = $wishlistId AND wp.productId = $productId";
        $result = PDOManager::fetch($sql);
        return $result;
    }

    public static function addProductToWishlist($wishlistId, $productId) {
        $sql = "INSERT INTO `wishlistproducts` (`wishlistId`, `productId`) 
        VALUES ('$wishlistId', '$productId')";
        PDOManager::execute($sql);
    }

    public static function removeProductToWishlist($wishlistId, $productId) {
        $sql = "DELETE FROM `wishlistproducts` WHERE wishlistId = ".$wishlistId." AND  productId = ".$productId."";
        PDOManager::execute($sql);
    }

    public static function getWishlist($wishlistId) {
        $sql = "SELECT productId FROM `wishlistproducts` WHERE wishlistId = ".$wishlistId."";
        $productInWishlist = PDOManager::fetchAll($sql);

        return array_map(function ($item) {
            return $item["productId"];
        }, $productInWishlist);
    }

    public static function getWishlistProduct($wishlistId) {
        $sql = "SELECT p.*, wp.wishlistId, b.name brandName 
        FROM `products` p 
        INNER JOIN `wishlistproducts` wp ON p.id = wp.productId 
        INNER JOIN `brands` b ON p.brandId = b.id
        WHERE wp.wishlistId = ".$wishlistId."";

        $wishlistProducts = PDOManager::fetchAll($sql);
        $allWishListProducts = [];
        foreach($wishlistProducts as $wishlistProduct) {
            $product = new Product(
                $wishlistProduct["id"],
                $wishlistProduct["name"], 
                $wishlistProduct["price"], 
                $wishlistProduct["image"], 
                $wishlistProduct["colour1"], 
                $wishlistProduct["colour2"], 
                $wishlistProduct["brandName"]
            );
            $allWishListProducts[] = 
            new WishlistProduct($product);
        }

        return $allWishListProducts;
    }

    public static function deleteProductFromWishlist($wishlistId, $productId) {
        $sql = "DELETE FROM `wishlistproducts` WHERE wishlistId = ".$wishlistId." AND productId = ".$productId."";
        PDOManager::execute($sql);
    }
} 

?>