<?php 
DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
require_once(ROOT_PATH ."services/productManager.php");
require_once(ROOT_PATH ."services/wishlistManager.php");
require_once(ROOT_PATH ."services/brandManager.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ressources/css/shop.css" type="text/css" />
        <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
        <title>Nos montres</title>
        <script src="https://kit.fontawesome.com/023f9dd6c0.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
            $sortDesc = false;
            if(isset($_POST["products-prices"])) {
                $sortDesc = $_POST["products-prices"] === "desc";
            }

            $selectedBrands = [];
            if(isset($_POST["brand-products"])) {
                 $selectedBrands = $_POST["brand-products"];
            }

            $wishList = [];

            if(isset($_SESSION["user"])) {
                $wishlistId = $_SESSION["user"]["wishlist"]->getId();

                if(isset($_POST["add-to-wishlist"]) && $_POST["product-id"]){
                    $productId = $_POST["product-id"];
                    WishListManager::toggleProductIntoWishlist($wishlistId, $productId);
                    echo "<meta http-equiv='refresh' content='0'>";
                }

                $wishList = WishListManager::getWishlist($wishlistId);               
            }

            $selectedProduct = "";
            if (isset($_GET["product"])) {                
                $selectedProduct = $_GET["product"];
            }
  
            $brands = BrandManager::getBrands();  
            $currentProduct = ProductManager::getProducts($selectedProduct, $selectedBrands, $sortDesc);
            
        ?>


        <div class="banner-container"> 
            <img class="shop-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type; ?>-list-banner.png"
                alt="<?php echo $currentProduct->infos->type ?> list banner">
            <h1 class="banner-title">LES <span class="orange-highlight uppercase"><?php echo $currentProduct->infos->pluralName; ?></span></h1>
            <p class="banner-text">Découvrez notre sélection de <?php echo $currentProduct->infos->pluralName;?></p>
            <div class="header-container">
                <?php
                    include(ROOT_PATH ."layout/header.php");
                ?>
            </div>
            
            
        </div>


        <div class="products-research-options-container">
                <div class="brand-research-container">
                    <h2 class="subtitle">Choisir une marque</h2>
                    <form class="brand-cards-container" action="#" method="POST">
                        <?php
                            for($i = 0; $i < count($brands); $i++) {
                                $brandName = $brands[$i]->getName();
                                echo "<div class=\"brand-card\">
                                    <img class=\"brand-card-logo\" src=\"ressources/images/logos/logo-".$brandName.".png\" alt=\"".$brandName." logo\">
                                    <input type=\"checkbox\" id=\"".$brandName."-products\" name=\"brand-products[]\" value= \"".$brandName."\" onclick=\"submit()\">
                                </div>";
                                }
                        ?>
                    </form>
                <h2 class="subtitle">Choisir un produit</h2>
        
            </div>

            <div class="scroll-list-container">
                <form action="#" method="POST">
                    <label for="product-select">Trier les produits</label>
                    <select name="products-prices" id="product-select" onChange = "submit()">
                        <option value="">Trier par:</option>
                        <option value="asc">Prix croissant</option>
                        <option value="desc">Prix décroissant</option>
                    </select>
                </form>
            </div>

        </div>

        <div class="products-grid-container">
            <div class="products-line-container">
                <?php

                for($i = 0; $i < count($currentProduct->items); $i++){
 
                        $currentItem = $currentProduct->items[$i];
                        $productId = $currentItem->getId();
                        $productKey = array_search($productId, $wishList);
                        
                        $productDisplayClass = $productKey !== false ? "wishlist-selected" : "wishlist-unselected";
                       
                        echo "<div class=\"product-card\">
                        <div class=\"add-to-wishlist-form-container\">
                            <form action=\"#\" method=\"POST\">
                                <input type=\"hidden\" name=\"product-id\" value=\"".$currentItem->getId()."\">
                                <button type=\"submit\" name=\"add-to-wishlist\" class=\"".$productDisplayClass."\" id=\"wishlist-button\"><i class=\"fas fa-heart test-colour\"></i></button>
                            </form>
                        </div>

                        <img class=\"".$currentProduct->infos->type."\" src=\"".$currentItem->getImage()."\" alt=\"".$currentProduct->infos->type." picture\">

                        <div class=\"miniature-product-container\">
                                <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$currentProduct->infos->type.$currentItem->getId().".png\"
                                alt=\"".$currentProduct->infos->type." picture\">
                                <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$currentProduct->infos->type.$currentItem->getId()."-colour2.png\"
                                alt=\"".$currentProduct->infos->type." picture\">
                        </div>
                        <h2 class=\"product-name\">".$currentItem->getName()."</h2>
                        <p class=\"product-price\">".$currentItem->getPrice()."€</p>
                        <a class=\"red-button\" href=\"article.php?product=$selectedProduct&amp;id=".$currentItem->getId()."\"><p class=\"button-content\">Découvrir</p></a>
                    </div>";
                    }
                ?>
            </div>
        </div>

        <?php
            include("layout/footer.php");
        ?>
        <script type="text/javascript" src="ressources/scripts/shop.js"></script>
    </body>
</html>