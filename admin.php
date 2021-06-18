<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/pdo.php");
    require_once(ROOT_PATH ."services/pdoManager.php");
    require_once(ROOT_PATH ."services/authentificationManager.php");
    require_once(ROOT_PATH ."services/AdminManager.php");

    session_start();
    if(!isset($_SESSION["user"]["isAdmin"])){
        header("Location: profile.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/admin.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Tableau de bord</title>
</head>
<body>

<?php
    $users = AdminManager::getAllUsers();
    $products = AdminManager::getAllProductsFromDatabase();
?>

    <div class="banner-container">
        <img src="ressources/images/banners/admin-dasboard-banner.png" alt="people who are running">
        <h1 class="banner-title">Tableau de <span class="orange-highlight">bord</span></h1>
        <div class="header-container">
            <?php
                include( ROOT_PATH . "layout/header.php");
            ?>
        </div>
    </div>

    <section class="users-management-section">
        <div>
            <h2>Gestion des utilisateurs</h2>
            <img src="" alt="">
        </div>
    </section>

    <table id="users">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <?php

                    if(isset($_POST["user-username-validation-button"])){
                        if(isset($_POST["user-username"])
                        && !empty($_POST["user-username"])) {
                            $username = $_POST["user-username"];
                            $userId = $_POST["user-id"];
                            //AdminManager::changeUserUsername($username, $userId);
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                    }
                ?>

                <tbody>
                    <?php
                        foreach($users as $user) {
                            echo "<tr>";
                                echo "<td>";
                                    echo "<input type=\"hidden\" name=\"user-id\" value=\"".$user->getId()."\">";
                                    echo "<p>".$user->getUsername()."</p>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<p>".$user->getEmail()."</p>";
                                echo "</td>";

                                echo "<td>";
                                    $role = $user->getRole(); 
                                    $checked = $role == 1 ? "checked" : "";
                                    echo "<input class=\"checkbox\" type=\"checkbox\" id=\"role-checkbox\" name=\"user-role\" ".$checked." disabled>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a class=\"update-link-button\" href=\"editUser.php?userid=".$user->getId()."\">Modifier</a>";
                                echo "</td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>


    <section class="users-management-section">
        <div>
            <h2>Gestion des produits</h2>
            <img src="" alt="">
        </div>

        <!-- <form action="#" method="POST">

            <label for="new-product-picture">Saisissez le chemin de l'image du produit</label>
            <input type="text" name="new-product-picture" id="new-product-picture" placeholder="Ex: ressources/images/products/">

            <label for="new-product-name">Saisissez le nom du produit</label>
            <input type="text" name="new-product-name" id="new-product-name" placeholder="Ex: Montre Zysce GS">

            <label for="new-product-price">Saisissez le prix du produit</label>
            <input type="text" name="new-product-price" id="new-product-price" placeholder="Ex: 999">

            <label for="new-product-colour1">Saisissez le couleur 1 du produit</label>
            <input type="text" name="new-product-colour1" id="new-product-colour1" placeholder="Ex: Bleu">

            <label for="new-product-colour2">Saisissez le couleur 2 du produit</label>
            <input type="text" name="new-product-colour2" id="new-product-colour2" placeholder="Ex: Vert">

            <label for="new-product-brand">Saisissez la marque du produit</label>
            <input type="text" name="new-product-brand" id="new-product-brand" placeholder="Ex: Runzik">

            <button class="btn" type="submit" name="add-new-product">Ajouter produit</button>
        </form> -->

        <div>
            <table id="products">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Nom du produit</th>
                        <th>Prix du produit</th>
                        <th>Marque du produit</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        foreach($products as $product) {
                            echo "<tr>";
                                echo "<td>";
                                    echo "<input type=\"hidden\" name=\"product-id\" value=\"".$product->getId()."\">";
                                    echo "<img class=\"product-picture\" src=\"".$product->getImage()."\" alt=\"product-picture\">";
                                echo "</td>";

                                echo "<td>";
                                    echo "<p>".$product->getName()."</p>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<p>".$product->getPrice()."</p>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<p>".$product->getBrand()."</p>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a class=\"product-update-link-button\" href=\"editProduct.php?productid=".$product->getId()."\">Modifier</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>   
    </section>  
</body>
</html>