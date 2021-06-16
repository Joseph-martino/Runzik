<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/cart.php");
require_once(ROOT_PATH ."models/wishlist.php");
class Authentication {

    public static function register($nickname, $email, $password){
        if(isset($nickname, $email, $password)
            && !empty($nickname) && !empty($email) && !empty($password)) {
                $pseudo = strip_tags($nickname);
                    if(SELF::isCorrectMail($email)) {
                        
                        $sql = "SELECT COUNT(*) OCC FROM users WHERE email = '".$email."'";

                        $result = PDOManager::fetch($sql);
                        if((int)$result["OCC"] >= 1) {
                            return false;
                        }
                    }
                        
                    if(SELF::isCorrectPassword($password)){
                        $pass = password_hash($password, PASSWORD_ARGON2ID);
                        
                        $sql = "INSERT INTO `users` (`username`,`email`, `password`, `isAdmin`) VALUES (:pseudo, :email, '$pass', false)";
                        $parameters = [
                            [
                                "name" => ":pseudo",
                                "value" => $pseudo,
                                "type" => PDO::PARAM_STR
                            ],
                            [
                                "name" => ":email",
                                "value" => $email,
                                "type" => PDO::PARAM_STR
                            ]
                        ];
                        
                        $userId = PDOManager::execute($sql, $parameters);

                        $cartId = SELF::createCartForUser($userId);
                        $wishlistId = SELF::createWishListForUser($userId);
                        $cart = new Cart($cartId);
                        $wishlist = new Wishlist($wishlistId);
                        
                        $_SESSION["user"] = [
                            "id" => $userId,
                            "pseudo" => $pseudo,
                            "email" => $email,
                            "isAdmin" => false,
                            "cart" => $cart,
                            "wishlist" => $wishlist,
                            "address" => null,
                            "phoneNumber" => null
                        ];
                    header("Location: profile.php");
                       echo "Bienvenue ".$_SESSION["user"]["pseudo"];

                    } else {
                        //echo "Entrez un mot de passe de 8 à 15 caractères comprenant au moins: une minuscule, une majuscule, un chiffre et un caractère -+!*$@%_";
                        return false;
                    }
        
                } else {
                    //die("Le formulaire est incomplet");
                    return false;
                }
                return true;
    }

    public static function login($email, $password) {
    
            if(isset($email, $password)
            && !empty($email && !empty($password))) 
            {
                if(!SELF::isCorrectMail($email)) {
                    //echo "email correcte";
                    return false;
                }

                $sql = "SELECT u.id userId, u.username, u.email, u.password, u.isAdmin, a.adress address, a.phoneNumber phoneNumber, c.id cartId, w.id wishlistId,
                COALESCE(SUM(cp.quantity), 0) quantity 
                FROM `users` u 
                LEFT JOIN `addresses` a ON u.adressId = a.id
                INNER JOIN `carts` c ON u.id = c.userId 
                INNER JOIN `wishlists` w ON u.id = w.userId 
                LEFT JOIN `cartsproducts` cp ON c.id = cp.cartId 
                WHERE u.email = :email";

                $parameters = [
                    [
                        "name" => ":email",
                        "value" => $email,
                        "type" => PDO::PARAM_STR
                    ]
                ];

                $user = PDOManager::fetch($sql, $parameters);
                $cartId = $user["cartId"];
                $wishlistId = $user["wishlistId"];
                $address = $user["address"];
                $phoneNumber = $user["phoneNumber"];
                $cart = new Cart($cartId);
                $wishlist = new Wishlist($wishlistId);
                $quantity = $user["quantity"];
                
                if(!$user){
                    // echo "L'utilisateur et/ou le mot de passe est incorrect";
                    // return;
                    return false;
                }
                if(!password_verify($password, $user["password"])){
                    // echo "L'utilisateur et/ou le mot de passe est incorrect";
                    // return;
                    return false;
                }
                
                $_SESSION["user"] = [
                    "id" => $user["userId"],
                    "pseudo" => $user["username"],
                    "email" => $user["email"],
                    "isAdmin" => $user["isAdmin"],
                    "quantity" => $quantity,
                    "cart" => $cart,
                    "wishlist"=> $wishlist,
                    "address"=> $address,
                    "phoneNumber" => $phoneNumber  
                ];

            header("Location: profile.php");
            echo "Bienvenue ".$_SESSION["user"]["pseudo"];
            }
            return true; 
    }

    public static function isCorrectPassword($password) {
        return preg_match("#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$#", $password);
    }

    private static function isCorrectMail($email){
        return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" , $email);
    }

    private static function createCartForUser($userId) {
        $sql = " INSERT INTO `carts` (`userId`) VALUES (:userId)";
        $parameters = [
            [
                "name" => ":userId",
                "value"=> $userId,
                "type" => PDO::PARAM_INT
            ]
        ];

        return PDOManager::execute($sql, $parameters);
    }

    private static function createWishListForUser($userId) {
        $sql = "INSERT INTO `wishlists` (`userId`) VALUES (:userId)";
        $parameters = [
            [
                "name" => ":userId",
                "value"=> $userId,
                "type"=> PDO::PARAM_INT
            ]
        ];
        return PDOManager::execute($sql, $parameters);
    }
}

?>