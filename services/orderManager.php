<?php

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