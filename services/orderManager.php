<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/product.php");
require_once(ROOT_PATH ."models/orderProduct.php");

    class OrderManager {

        public static function createOrderFromCart($userId, $cartId) {
            $orderId = SELF::createOrder($userId);
            $sql = "INSERT INTO `orderproducts` (orderId, productId, quantity)
            SELECT :orderId, productId, quantity FROM `cartsproducts`
            WHERE cartId = :cartId";

            $parameters = [

                [
                    "name" => ":orderId",
                    "value" => $orderId,
                    "type" => PDO::PARAM_INT
                ],

                [
                    "name" => ":cartId",
                    "value" => $cartId,
                    "type" => PDO::PARAM_INT
                ]
            ];
            PDOManager::execute($sql, $parameters);
        }


        public static function getOrderProducts($userId) {
            $sql ="SELECT orderId, quantity productQuantity, 
            created_at date, p.id productId, p.name, 
            p.price, p.image, p.colour1, 
            p.colour2, b.name brandName 
            FROM `orderproducts` op 
            INNER JOIN `orders` o ON op.orderId = o.id 
            INNER JOIN `users` u ON o.userId = u.id 
            INNER JOIN `products` p ON op.productId = p.id 
            INNER JOIN `brands` b ON p.brandId = b.id
            WHERE userId = :userId";

            $parameters = [
                [
                    "name" => ":userId",
                    "value" => $userId,
                    "type" => PDO::PARAM_INT
                ]
            ];

            $orderProducts = PDOManager::fetchAll($sql, $parameters);
            $allOrderProducts = [];
            foreach($orderProducts as $orderProduct){
                $product = new Product(
                    $orderProduct["productId"],
                    $orderProduct["name"], 
                    $orderProduct["price"], 
                    $orderProduct["image"], 
                    $orderProduct["colour1"], 
                    $orderProduct["colour2"], 
                    $orderProduct["brandName"]
                );
               $allOrderProducts[] = 
               new OrderProduct(
                   $product, 
                   $orderProduct["orderId"], 
                   $orderProduct["productQuantity"],
                   $orderProduct["date"] 
               );
            }
            return $allOrderProducts;
        }

        private static function createOrder($userId){
            $sql = "INSERT INTO `orders` (userId)
            VALUES (:userId)";

            $parameters = [
                [
                    "name" => ":userId",
                    "value" => $userId,
                    "type" => PDO::PARAM_INT
                ]
            ];
            return PDOManager::execute($sql, $parameters);
        }
    }
?>