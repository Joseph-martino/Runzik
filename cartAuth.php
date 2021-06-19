<?php 
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/pdo.php");
    require_once(ROOT_PATH ."services/pdoManager.php");
    require_once(ROOT_PATH ."services/productManager.php");
    require_once(ROOT_PATH ."services/cartManager.php");
    require_once(ROOT_PATH ."services/orderManager.php");
    require_once(ROOT_PATH . "models/product.php");
    require_once(ROOT_PATH . "models/products.php");
    require_once(ROOT_PATH . "models/cart.php");
    require_once(ROOT_PATH . "models/cartProduct.php");
    session_start();

    $cartId = $_SESSION["user"]["cart"]->getId();

    if(!empty($_POST)) {
        if(isset($_POST["username"]) && !empty($_POST["username"])) {
            $pseudo = strip_tags($_POST["username"]);
            var_dump($_POST["username"]);
            $pdo = myPDO::getPDO();               
            $sql = "UPDATE `users` SET `username` = :pseudo WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
            $query = $pdo->prepare($sql); 
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->execute();
            var_dump($query);
            var_dump($_SESSION["user"]);
            $_SESSION["user"]["pseudo"] = $pseudo;
        }
    
        if(isset($_POST["password"]) && !empty($_POST["password"])) {
            var_dump($_POST["password"]);
            if(Authentication::isCorrectPassword($_POST["password"])) {
                $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
                $pdo = myPDO::getPDO();               
                $sql = "UPDATE `users` SET `password` = :password WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                $query = $pdo->prepare($sql); 
                $query->bindValue(":password", $pass, PDO::PARAM_STR);
                $query->execute();
                var_dump($query);
            } else {
                die ("Mot de passe incorrect");
            }
            
        }
    
        if(isset($_POST["email"]) && !empty($_POST["email"])) {
            var_dump($_POST["email"]);
            if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" , $_POST["email"])) {
                $pdo = myPDO::getPDO();               
                $sql = "UPDATE `users` SET `email` = :email WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                $query = $pdo->prepare($sql); 
                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query->execute();
                var_dump($query);
                var_dump($_SESSION["user"]);
                $_SESSION["user"]["email"] = $_POST["email"];
            } else {
                die ("Ce n'est pas un email");
            }
            
        }
    
        if(isset($_POST["phoneNumber"]) && !empty($_POST["phoneNumber"])) {
            if(preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#" , $_POST["phoneNumber"])) {
                $query = "SELECT a.phoneNumber FROM `addresses` a INNER JOIN `users` u ON u.adressId = a.id WHERE u.id = ".$_SESSION["user"]["id"]."";
                $phoneNumber = PDOManager::fetch($query);
                var_dump($phoneNumber);
                if($phoneNumber == null){
                    $pdo = myPDO::getPDO();
                    $query = "INSERT INTO `addresses` (`phoneNumber`) VALUES (".$_POST["phoneNumber"].")";    
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                    $id = $pdo->lastInsertId();
    
                    $pdo = myPDO::getPDO();
                    $query = "UPDATE `users` SET `adressId` = '".$id."' WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                
                } else {
                    $pdo = myPDO::getPDO();
                    $query = "UPDATE addresses a INNER JOIN users u ON a.id = u.adressId SET phoneNumber = '".$_POST["phoneNumber"]."' WHERE u.id = ".$_SESSION["user"]["id"]."";
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                }
                $_SESSION["user"]["phoneNumber"] = $_POST["phoneNumber"]; 
            } else {
                echo "numéro de téléphone incorrect";
            }    
        }
    
        if(isset($_POST["adress"]) && !empty($_POST["adress"])) {
                var_dump($_POST["adress"]);
                $query = "SELECT a.adress FROM `addresses` a INNER JOIN `users` u ON u.adressId = a.id WHERE u.id = ".$_SESSION["user"]["id"]."";
                $adress = PDOManager::fetch($query);
                var_dump($adress);
                if($adress == null){
                    $pdo = myPDO::getPDO();
                    $query = "INSERT INTO `addresses` (`adress`) VALUES ('".$_POST["adress"]."')"; // faire un bind value
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                    $id = $pdo->lastInsertId();
    
                    $pdo = myPDO::getPDO();
                    $query = "UPDATE `users` SET `adressId` = '".$id."' WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                
                } else {
                    $pdo = myPDO::getPDO();
                    $query = "UPDATE addresses a INNER JOIN users u ON a.id = u.adressId SET adress = '".$_POST["adress"]."' WHERE u.id = ".$_SESSION["user"]["id"]."";
                    $statement = $pdo->prepare($query); 
                    $statement->execute();
                }
                $_SESSION["user"]["address"] = $_POST["adress"];  
        }
    
        if(isset($_POST["delete"])) {
                $pdo = myPDO::getPDO();               
                $sql = "DELETE FROM `users` WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                $query = $pdo->prepare($sql); 
                $query->execute();
    
                $sql = "DELETE FROM `addresses` WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
                $query = $pdo->prepare($sql); 
                $query->execute();
    
                var_dump($query);
                var_dump($_SESSION["user"]);
                unset($_SESSION["user"]);
                header("Location: index.php"); 
        }

                if(isset($_POST["create-order"])) {
                    OrderManager::createOrderFromCart($_SESSION["user"]["id"], $cartId);
                    CartManager::deleteAllProductsFromCart($cartId);
                }

        

        
    }
            
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/cartAuth.css" type="text/css"/>
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Validation de ma commande</title>
</head>
<body>
    <?php
        include( ROOT_PATH . "layout/header.php");
        include( ROOT_PATH . "layout/mobileHeader.php");
        var_dump($_SESSION["user"]);
        $cartProducts = CartManager::getCartProducts($cartId);
    ?>

        <div class="main-container">
            <section class="left-panel">
                <div class="profile-header">
                    <h1><?php echo $_SESSION["user"]["pseudo"]?></h1>
                    <div class="top-line horizontal-separator"></div>
                    <div class="middle-line horizontal-separator"></div>
                    <div class="bottom-line horizontal-separator"></div>
                </div>

                <div class="user-general-informations-wrapper mobile-sections-margins">
                    <div class="title-container">
                        <img src="ressources/images/icons/profile-information-icon.png" alt="informations-icon">
                        <h2>Informations générales</h2>
                    </div>

                    <div class="user-infos-container pink-borders">
                        <div class="line">
                            <p>Nom:</p>
                            <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
                        </div>

                        <div class="line">
                            <p>Prénom:</p>
                            <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
                        </div>
                    </div>
                </div>

                <div class="user-contact-informations-wrapper mobile-sections-margins">
                    <div class="title-container">
                        <img src="ressources/images/icons/profile-information-icon.png" alt="informations-icon">
                        <h2>Coordonnées</h2>
                    </div>

                    <div class="user-infos-container blue-borders">

                        <div class="line mobile-input-line">
                            <p>Adresse de livraison:</p>
                            <form action="#" method="POST">
                                <input class="input-field" type="text" name="adress" value="<?php echo $_SESSION["user"]["address"]?>">
                                <button class="update-information-button" type="submit">
                                    <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                </button>
                            </form>
                        </div>

                        <div class="line mobile-input-line">
                            <p>Numéro de téléphone:</p>
                            <form action="#" method="POST">
                                <input class="input-field" type="text" name="phoneNumber" value="<?php echo $_SESSION["user"]["phoneNumber"]?>">
                                <button class="update-information-button" type="submit">
                                    <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- <form action="#" method="POST"> 
                        <button class="order-validation-button" type="submit" name="order-validation">Valider la commande</button>
                    </form> -->
                </div>
            </section>

            <section>
                <?php

if(isset($_POST["product-id"], $_POST["product-quantity"])){
        CartManager::updateProductQuantityFromCart($cartId, $productId, $productQuantity);
        echo "<meta http-equiv='refresh' content='0'>";
}





             
                     foreach($cartProducts as $cartProduct) {

                                echo "<img class=\"product-picture\" src=\"".$cartProduct->getProductImage()."\" alt=\"product-picture\">";
                                echo "<h2>".$cartProduct->getProductName()."</h2>";
                                echo "<p>".$cartProduct->getProductPrice()."</p>";
                                echo "<p>".$cartProduct->getProductSubtotal()."</p>";
                                
                                
                        // echo "<tr>";
                        //     echo "<td><img class=\"product-picture\" src=\"".$cartProduct->getProductImage()."\" alt=\"product-picture\"></td>";
                        //     echo "<td>".$cartProduct->getProductName()."</td>";
                        //     // echo "<td>";
                        //     //     echo "<form action=\"#\" method=\"POST\">";
                        //     //     echo "<input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">";
                        //     //     echo "<input type=\"number\" name=\"product-quantity\" min=\"0\" value=\"".$cartProduct->getQuantity()."\" onChange=\"submit()\"></td>";
                        //     //     echo "</form>";
                        //     // echo "</td>";
                        //     echo "<td>".$cartProduct->getProductPrice()."</td>";
                        //     echo "<td>".$cartProduct->getProductSubtotal()."</td>";
                        //     echo "<td>";
                        //         echo "<form action=\"#\" method=\"POST\">";
                        //         echo "<input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">";
                        //         echo "<input type=\"hidden\" name=\"product-quantity\" min=\"0\" value=\"".$cartProduct->getQuantity()."\"></td>";
                        //         echo "<button type=\"submit\" name=\"order-validation\">VALIDER LA COMMANDE</button>";
                        //         echo "</form>";
                        //     echo "</td>";
                        // echo "</tr>";
                    }
                ?>
            </section>

            

            <form action="#" method="POST">
                <div class="GDPR-verification-container">
                    <input class="checkbox" type="checkbox" id="grpr-verification" name="gdpr-verification" required>
                    <label class="grpd-message" for="grpr-verification">j'ai lu et j'accepte les <a href="gdpr.php">termes</a> et <a href="gdpr.php#standart-form-contract">conditions de vente</a> </label>
                </div>
                 <button type="submit" name="create-order">Valider la commande</button>
            </form>
                
            <!-- <section  class="right-panel">
                <img src="ressources/images/illustrations/order-confirmation-picture.png" alt="order confirmation picture">
            </section> -->
        </div>
        <?php
            include(ROOT_PATH ."layout/footer.php");
        ?>
    </body>
</html>