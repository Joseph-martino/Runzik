<?php

require_once(ROOT_PATH . "models/product.php");
require_once(ROOT_PATH . "models/user.php");
require_once(ROOT_PATH ."services/pdoManager.php"); 

class AdminManager {

    public static function getAllUsers() {
        $sql = "SELECT u.id, u.username, u.email, u.isAdmin role
        FROM `users` u";
        $users = PDOManager::fetchAll($sql);
        $allUsers = [];
        foreach($users as $user) {
            $allUsers[] = 
            new User(
                $user["id"],
                $user["username"],
                $user["email"],
                $user["role"]
            );
        }
        return $allUsers;
    }

    public static function getUser($id) {
        $sql = "SELECT id, username, email, isAdmin role FROM `users` WHERE id = ".$id."";
        $result = PDOManager::fetch($sql);
        $user = new User (
            $result["id"],
            $result["username"],
            $result["email"],
            $result["role"]
        );
        return $user;
    }

    public static function deleteUserFromDatabase($userId) {
        $sql = "DELETE FROM `users` WHERE id = '".$userId."'";
        PDOManager::execute($sql);
    }

    public static function updateUser($username, $email, $isAdmin, $userId) {
        $sql = "UPDATE `users` SET 
        username = :username,
        email = :email,
        isAdmin = :isAdmin
        WHERE id = ".$userId."";
        $parameters = [
            [
                "name" => ":username",
                "value" => $username,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":email",
                "value" => $email,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":isAdmin",
                "value" => $isAdmin,
                "type" => PDO::PARAM_BOOL
            ]
        ];

        PDOManager::execute($sql, $parameters);
        return true;
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

    public static function getProduct($id) {
        $sql = "SELECT p.*, b.name brandName
        FROM `products` p 
        INNER JOIN `brands` b ON p.brandId = b.id WHERE p.id = ".$id."";
        $result = PDOManager::fetch($sql);
        $product = new Product(
                $result["id"],
                $result["name"], 
                $result["price"], 
                $result["image"], 
                $result["colour1"], 
                $result["colour2"], 
                $result["brandName"],
                $result["brandId"]
        );
        return $product;
    }

    public static function updateProduct($name, $price, $brandId, $id) {
        $sql = "UPDATE `products` SET 
        name = :name,
        price = :price,
        brandId = :brandId
        WHERE id = ".$id."";

        $parameters = [
            [
                "name" => ":name",
                "value" => $name,
                "type" => PDO::PARAM_STR
            ],
            [
                "name" => ":price",
                "value" => $price,
                "type" => PDO::PARAM_INT
            ],
            [
                "name" => ":brandId",
                "value" => $brandId,
                "type" => PDO::PARAM_INT
            ]
        ];
        PDOManager::execute($sql, $parameters);
        return true;
    }

    public static function getAllBrands() {
        $sql = "SELECT id, name FROM `brands`";
        $result = PDOManager::fetchAll($sql);
        return $result;
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

    public static function deleteProductFromDatabase($productId) {
        $sql = "DELETE FROM `products` WHERE id = '".$productId."'";
        PDOManager::execute($sql);
    }



}




?>