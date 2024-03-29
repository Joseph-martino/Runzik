<?php   
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
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
    <link rel="stylesheet" href="ressources/css/editUser.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Modification utilisateur</title>
</head>
<body>


    <?php
        include(ROOT_PATH ."layout/header.php");
        include(ROOT_PATH ."layout/mobileHeader.php");

        $currentProductId = $_GET["productid"];
        $currentProduct = AdminManager::getProduct($currentProductId);
        $currentProductBrandId = $currentProduct->getBrandId();
        $brands = AdminManager::getAllBrands();
        $updateSuccess = false;
    ?>
        <section>
            <div class="title-container">
                <h2><?php echo $currentProduct->getName() ?></h2>
            </div>

            <?php
                if(isset($_POST["product-update"])){
                    if(isset($_POST["product-name"], $_POST["product-price"], $_POST["product-brand"] ) 
                    && !empty($_POST["product-name"]) && !empty($_POST["product-price"]) && !empty($_POST["product-brand"])){
                        $name = $_POST["product-name"];
                        $price = $_POST["product-price"];
                        $brandId = $_POST["product-brand"];
                        $productId = $_POST["product-id"];
                        $updateSuccess = AdminManager::updateProduct($name, $price, $brandId, $productId);
                        echo "<meta http-equiv='refresh' content='0'>";  
                    }
                }
            ?>

            <?php
            //     if($updateSuccess === true) {
            //         echo "<div id=\"update-information-panel-container\" class=\"hide-message\">";
            //             echo "<div class=\"update-information-panel\">";
            //                 echo "<img class=\"update-panel-background\" src=\"ressources/images/banners/update-success-background.png\" alt=\"update success background\">";
            //                 echo "<img class=\"update-panel-icon\" class=\"update-information-icon\" src=\"ressources/images/icons/update-success-icon1.png\" alt=\"pencil icon\">";
            //                 echo "<div class=\"update-panel-content\">";
            //                     echo "<h2 class=\"update-panel-title\">Super !</h2>";
            //                     echo "<p class=\"update-panel-text\">Mise à jour effectuée avec succès</p>";
            //                 echo "</div>";
            //             echo "</div>";
            //         echo "</div>";
            //     }
            // ?>

                    <div id="update-information-panel-container" class="hide-message">
                        <div class="update-information-panel">
                            <img class="update-panel-background" src="ressources/images/banners/update-success-background.png" alt="update success background">
                            <img class="update-panel-icon" class="update-information-icon" src="ressources/images/icons/update-success-icon1.png" alt="pencil icon">
                            <div class="update-panel-content">
                                <h2 class="update-panel-title">Super !</h2>
                                <p class="update-panel-text">Mise à jour effectuée avec succès</p>
                            </div>
                        </div>
                    </div>

            <div class="main-content-container">
                <div class="form-container">
                    <form action="#" method="POST">
                        <input type="hidden" name="product-id" value="<?php echo $currentProduct->getId()?>">
                        <label for="product-name">Nom du produit</label>
                        <input type="text" id="product-name" name="product-name" value="<?php echo $currentProduct->getName()?>">

                        <label for="product-price">Prix du produit</label>
                        <div class="product-price-input-container">
                            <input type="text" id="product-price" name="product-price" value="<?php echo $currentProduct->getPrice()?>">
                            <p>€</p>
                        </div>
                        
                        <h2 class="product-brand-container">Marque du produit</h2>
                        <div class="brand-radio-input-container">
                            <div class="input-container">
                                <?php 
                                    foreach($brands as $brand) {
                                        $checked = $currentProductBrandId === $brand["id"] ? "checked" : "";
                                        echo "<div class=\"brand-input-container\">";
                                            echo "<label for=\"brand-".$brand["name"]."\">".$brand["name"]."</label>";
                                            echo "<input type=\"radio\" id=\"brand-".$brand["name"]."\" name=\"product-brand\" value=\"".$brand["id"]."\" ".$checked.">";
                                        echo "</div>";
                                    } 
                                ?>
                            </div>
                        </div>

                        <div class="buttons-container">
                            <button id="update-button" type="submit" name="product-update">Valider les changements</button>
                            <a class="btn-back-to-dashboard" href="admin.php">Retour au tableau de bord</a>
                        </div>
                        
                    </form>
                </div>
                
                <img class="product-picture" src="<?php echo $currentProduct->getImage()?>" alt="woman running picture">
            </div>
        </section>
        <?php
            include( ROOT_PATH . "layout/footer.php");
        ?>
    

    <script type="text/javascript" src="ressources/scripts/edit.js"></script>
</body>
</html>