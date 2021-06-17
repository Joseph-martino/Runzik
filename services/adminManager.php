<?php

require_once(ROOT_PATH . "models/product.php");
require_once(ROOT_PATH . "models/user.php");

class AdminManager {

    public static function getAllUsers() {
        $sql = "SELECT u.id, u.username, u.email, u.password, u.isAdmin role
        FROM `users` u";
        $users = PDOManager::fetchAll($sql);
        $allUsers = [];
        foreach($users as $user) {
            $allUsers[] = 
            new User(
                $user["id"],
                $user["username"],
                $user["email"],
                $user["password"],
                $user["role"]
            );
        }
        return $allUsers;
    }

    public static function deleteUserFromDatabase($userId) {
        $sql = "DELETE FROM `users` WHERE id = '".$userId."'";
        PDOManager::execute($sql);
    }

    public static function changeUserUsername($username, $userId) {
        $sql = "UPDATE `users` SET username = :username WHERE id = ".$userId."";
        $parameters = [
            [
                "name" => ":username",
                "value" => $username,
                "type" => PDO::PARAM_STR
            ]
        ];

        PDOManager::execute($sql, $parameters);
    }

    public static function getAllProductsFromDatabase() {
        $sql = "SELECT p.*, b.name brandName
        FROM `products` p 
        INNER JOIN `brands` b ON p.brandId = b.id";
        $products = PDOManager::fetchAll($sql);
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
        return $allProducts;
    }

    public static function createNewProductInDatabase($name, $price, $image, $colour1, $colour2, $brandId) {
        $sql = "INSERT INTO `products` (`name`, `price`, `image`, `colour1`, `colour2`, `brandId`)
        VALUES (:name, :price, :image, :colour1, :colour2, :brandId)";
        $parameters = [
            [
                "name" => ":name",
                "value" => $name,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":price",
                "value" => $price,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":image",
                "value" => $image,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":colour1",
                "value" => $colour1,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":colour2",
                "value" => $colour2,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":brandId",
                "value" => $brandId,
                "type" => PDO::PARAM_INT
            ]
        ];
        PDOManager::execute($sql, $parameters);
    }



    public static function changeProductName($name, $productId) {
        $sql = "UPDATE `products` p SET p.name = ".$name."
        WHERE productId = '".$productId."'";
        PDOManager::execute($sql);
    }

    public static function changeProductPrice($price, $productId) {
        $sql = "UPDATE `products` p SET p.price = ".$price."
        WHERE productId = '".$productId."'";
        PDOManager::execute($sql);
    }

    public static function changeProductColour1($colour, $productId) {
        $sql = "UPDATE `products` p SET p.colour1 = ".$colour."
        WHERE productId = '".$productId."'";
        PDOManager::execute($sql);
    }

    public static function changeProductColour2($colour, $productId) {
        $sql = "UPDATE `products` p SET p.colour2 = ".$colour."
        WHERE productId = '".$productId."'";
        PDOManager::execute($sql);
    }

    public static function changeProductBrand($brandId, $productId) {
        $sql = "UPDATE `brands` b SET b.name = ".$brandId."
        WHERE productId = '".$productId."'";
        PDOManager::execute($sql);
    }

    public static function deleteProductFromDatabase($productId) {
        $sql = "DELETE FROM `products` WHERE id = '".$productId."'";
        PDOManager::execute($sql);
    }



}




?>