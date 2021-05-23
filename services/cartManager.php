<?php

require_once(ROOT_PATH ."services/pdo.php");

class CartManager {
    
// à corriger et terminer
    public static function addProductToCart($cartId, $productId, $quantity = 1) {
        $pdo = myPDO::getPDO();
        $sql = "INSERT INTO `cartsproducts` (`cartId`, `productId`, `quantity`) 
        VALUES ('$cartId', '$productId', '$quantity')";

        $parameters = [
            [
                "name" => "cartId",
                "value" => $cartId,
                "type" => PDO::PARAM_INT
            ]
        ];

        $statement = $pdo->prepare($sql, $parameters);
        $statement->execute();
        var_dump($statement);
    }

}



?>