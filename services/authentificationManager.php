<?php

require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."models/cart.php");
require_once(ROOT_PATH ."models/wishlist.php");
class Authentication {

    public static function register($nickname, $email, $password){
        if(isset($nickname, $email, $password)
                && !empty($nickname) && !empty($email) && !empty($password)
                ) {
                    $pseudo = strip_tags($nickname);
                  
                    if(SELF::isCorrectMail($email)) {
                        
                        $sql = "SELECT COUNT(*) OCC FROM users WHERE email = '".$email."'";

                        $result = PDOManager::fetch($sql);
                        var_dump($result);
                        if((int)$result["OCC"] >= 1) {
                            echo "l'adresse existe déjà";
                            return;
        
                        } else {
                            echo "l'adresse est correcte";
                        }
                    }
                        
                    if(SELF::isCorrectPassword($password)){
                        echo "mot de passe correct";

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
                            "wishlist" => $wishlist
                        ];
                    header("Location: profile.php");
                       echo "Bienvenue ".$_SESSION["user"]["pseudo"];

                    } else {
                        echo "Entrez un mot de passe de 8 à 15 caractères comprenant au moins: une minuscule, une majuscule, un chiffre et un caractère -+!*$@%_";
                    }
        
                } else {
                    die("Le formulaire est incomplet");
                }
    }

    public static function login($email, $password) {
    
        if(!empty($_POST)){
            if(isset($email, $password)
            && !empty($email && !empty($password))) 
            {
                if(SELF::isCorrectMail($email)) {
                    echo "email correcte";
                } else {
                    die ("Ce n'est pas un email");
                }

                $sql = "SELECT u.id userId, u.username, u.email, u.password, u.isAdmin, c.id cartId, w.id wishlistId,
                COALESCE(SUM(cp.quantity), 0) quantity 
                FROM `users` u 
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
                var_dump($parameters);
                var_dump($user);
                $cartId = $user["cartId"];
                $wishlistId = $user["wishlistId"];
                $cart = new Cart($cartId);
                $wishlist = new Wishlist($wishlistId);
                echo $cartId;
                $quantity = $user["quantity"];
               
                
                if(!$user){
                    echo "L'utilisateur et/ou le mot de passe est incorrect";
                    return;
                }
                if(!password_verify($password, $user["password"])){
                    echo "L'utilisateur et/ou le mot de passe est incorrect";
                    return;
                }
                
                $_SESSION["user"] = [
                    "id" => $user["userId"],
                    "pseudo" => $user["username"],
                    "email" => $user["email"],
                    "isAdmin" => $user["isAdmin"],
                    "quantity" => $quantity,
                    "cart" => $cart,
                    "wishlist"=> $wishlist    
                ];

                var_dump($_SESSION["user"]);

            header("Location: profile.php");
            echo "Bienvenue ".$_SESSION["user"]["pseudo"];
            }
        }  
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