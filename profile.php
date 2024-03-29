<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/pdo.php");
    require_once(ROOT_PATH ."services/pdoManager.php");
    require_once(ROOT_PATH ."services/authentificationManager.php");
    require_once(ROOT_PATH ."services/wishlistManager.php");
    require_once(ROOT_PATH ."services/orderManager.php");
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
        exit;
    }
?>



<?php
$wishlistId = $_SESSION["user"]["wishlist"]->getId();
$userId = $_SESSION["user"]["id"];

if(!empty($_POST)) {
    if(isset($_POST["username"]) && !empty($_POST["username"])) {
        $pseudo = strip_tags($_POST["username"]);
        $pdo = myPDO::getPDO();               
        $sql = "UPDATE `users` SET `username` = :pseudo WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
        $query = $pdo->prepare($sql); 
        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->execute();
        $_SESSION["user"]["pseudo"] = $pseudo;
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        if(Authentication::isCorrectPassword($_POST["password"])) {
            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            $pdo = myPDO::getPDO();               
            $sql = "UPDATE `users` SET `password` = :password WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
            $query = $pdo->prepare($sql); 
            $query->bindValue(":password", $pass, PDO::PARAM_STR);
            $query->execute();
        } else {
            die ("Mot de passe incorrect");
        }
        
    }

    if(isset($_POST["email"]) && !empty($_POST["email"])) {
        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" , $_POST["email"])) {
            $pdo = myPDO::getPDO();               
            $sql = "UPDATE `users` SET `email` = :email WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
            $query = $pdo->prepare($sql); 
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $_SESSION["user"]["email"] = $_POST["email"];
        } else {
            die ("Ce n'est pas un email");
        }
        
    }

    if(isset($_POST["phoneNumber"]) && !empty($_POST["phoneNumber"])) {
        if(preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#" , $_POST["phoneNumber"])) {
            $query = "SELECT a.phoneNumber FROM `addresses` a INNER JOIN `users` u ON u.adressId = a.id WHERE u.id = ".$_SESSION["user"]["id"]."";
            $phoneNumber = PDOManager::fetch($query);
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
            $query = "SELECT a.adress FROM `addresses` a INNER JOIN `users` u ON u.adressId = a.id WHERE u.id = ".$_SESSION["user"]["id"]."";
            $adress = PDOManager::fetch($query);
            if($adress == null){
                $pdo = myPDO::getPDO();
                $query = "INSERT INTO `addresses` (`adress`) VALUES ('".$_POST["adress"]."')"; 
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

    if(isset($_POST["delete-user"])) {
            $pdo = myPDO::getPDO(); 
            
            $sql = "SELECT adressId from users WHERE id = ".$_SESSION["user"]["id"];
            $result = PDOManager::fetch($sql);

            if (!empty($result['adressId'])) {
                $sql = "DELETE from addresses where id = ".$result['adressId'];
                PDOManager::execute($sql);
            }

            $sql = "DELETE FROM `users` WHERE id = ".$_SESSION["user"]["id"];
            $query = $pdo->prepare($sql); 
            $query->execute();
            unset($_SESSION["user"]);
            header("Location: index.php"); 
    }

    if(isset($_POST["product-id"], $_POST["delete-wishlist-product"])){
        $productId = $_POST["product-id"];
        WishListManager::deleteProductFromWishlist($wishlistId, $productId);
    }
}

    $wishlistProducts = WishListManager::getWishlistProduct($wishlistId);
    $orderProducts = OrderManager::getOrderProducts($userId); 
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/profile.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Profile</title>
</head>
    <body>

        <?php
            include(ROOT_PATH ."layout/header.php");
            include(ROOT_PATH ."layout/mobileHeader.php");
        ?>

        <div class="main-container">
            <div class="profile-header">
                <h1><?php echo $_SESSION["user"]["pseudo"]?></h1>
                <div class="top-line horizontal-separator"></div>
                <div class="middle-line horizontal-separator"></div>
                <div class="bottom-line horizontal-separator"></div>
            </div>

            <div class="sections-container">
                    <section>
                        <div class="user-general-informations-wrapper mobile-sections-margins">
                            <div class="title-container long-title-size cell-margin">
                                <img src="ressources/images/icons/profile-information-icon.png" alt="informations-icon">
                                <h2>Informations générales</h2>
                            </div>

                            <div class="user-general-informations-container pink-borders cell-margin cell-padding">
                                <div class="line">
                                    <p>Nom:</p>
                                    <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
                                </div>

                                <div class="line">
                                    <p>Prénom:</p>
                                    <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
                                </div>

                                <div class="line">
                                    <p>Pseudo:</p>
                                    <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
                                    <form action="#" method="POST">
                                        <input class="input-field" type="text" name="username">
                                        <button class="modify-background" type="submit">
                                            <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                        </button>
                                    </form>
                                </div>

                                <div class="line">
                                    <p>Mot de passe:</p>
                                    <form action="#" method="POST">
                                        <input class="input-field" type="password" name="password">
                                        <button class="modify-background" type="submit">
                                            <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                        </button>
                                    </form>
                                </div>

                                <div class="line">
                                    <p>Adresse mail:</p>
                                    <p><?php echo $_SESSION["user"]["email"] ?></p>
                                    <form action="#" method="POST">
                                    <input class="input-field" type="email" name="email">
                                        <button class="modify-background" type="submit">
                                            <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                        </button>
                                    </form>
                                </div>  
                            </div>
                        </div>

                        <div class="user-contact-informations-wrapper mobile-sections-margins">
                                <div class="title-container cell-margin">
                                    <img src="ressources/images/icons/profile-information-icon.png" alt="informations-icon">
                                    <h2>Coordonnées</h2>
                                </div>

                            <div class="user-contact-informations-container blue-borders cell-margin cell-padding">

                                <div class="line">
                                    <p>Adresse de livraison:</p>
                                    <form action="#" method="POST">
                                        <input class="input-field" type="text" name="adress">
                                        <button class="modify-background" type="submit">
                                            <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                        </button>
                                    </form>
                                </div>

                                <div class="line">
                                    <p>Numéro de téléphone:</p>
                                    <form action="#" method="POST">
                                        <input class="input-field" type="text" name="phoneNumber">
                                        <button class="modify-background" type="submit">
                                            <img src="ressources/images/icons/profile-modify-icon.png" alt="informations-icon">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                            <form class="desktop-delete-account-form" action="#" method="POST">
                                <input type="hidden" name="delete-user">
                                <button class="delete-button" type="submit">Supprimer le compte</button>
                            </form>
                </section>

                <section>
                    <div class="user-contact-informations-wrapper orders-cell-size mobile-sections-margins">
                        <div class="title-container cell-margin">
                            <img src="ressources/images/icons/profile-cart-icon.png" alt="informations-icon">
                            <h2>Commandes</h2>
                        </div>

                        <div class="user-contact-informations-container  orders-cell-size orange-borders cell-margin">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Marque</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($orderProducts as $orderProduct) {
                                        echo "<tr>";
                                            echo "<td><img class=\"ordered-product-picture\" src=\"".$orderProduct->getOrderProductImage()."\" alt=\"ordered product image\"</td>";
                                            echo "<td>".$orderProduct->getOrderProductName()."</td>";
                                            echo "<td>".$orderProduct->getProductQuantity()."</td>";
                                            echo "<td>".$orderProduct->getOrderProductBrand()."</td>";
                                            echo "<td>".$orderProduct->getDate()."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>   
                    </div>

                    <div class="user-contact-informations-wrapper wishlist-cell-size mobile-sections-margins">
                        <div class="title-container medium-title-size cell-margin">
                            <img src="ressources/images/icons/profile-wishlist-heart-icon.png" alt="informations-icon">
                            <h2>Liste de souhaits</h2>
                        </div>

                        <div class="user-contact-informations-container green-borders cell-margin">
                        <table class="wishlist-table">
                            <thead>
                                <tr>
                                    <th>Produit</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($wishlistProducts as $wishlistProduct) {
                                        echo "<tr>";
                                            echo "<td>".$wishlistProduct->getProductName()."</td>";
                                            echo "<td>";
                                                echo "<form action=\"#\" method=\"POST\">";
                                                echo "<input type=\"hidden\" name=\"product-id\" value=\"".$wishlistProduct->getProductId()."\">";
                                                echo "<button type=\"submit\" name=\"delete-wishlist-product\"><img src=\"ressources/images/icons/cart-bin-icon.png\" alt=\"delete icon\"</button>";
                                                echo "</form>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                ?> 
                            </tbody>
                        </table>
                        </div>   
                    </div>
                </section>
            </div>
            <form class="mobile-delete-account-form" action="#" method="POST">
                <input type="hidden" name="delete-user">
                <button class="mobile-delete-button" type="submit">Supprimer le compte</button>
            </form>
        </div>
        <?php
            include(ROOT_PATH ."layout/footer.php");
        ?>
    </body>
</html>