<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ressources/css/shop.css" type="text/css" />
        <title>Nos montres</title>
        <script src="https://kit.fontawesome.com/023f9dd6c0.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <?php
            include("layout/header.php");
        ?>

        <?php
            require("models/products.php");
        ?>
        
        <?php
            $selectedProduct = $_GET["product"];
            $brands = ["runzik", "beats", "hanuman"];
            $currentProduct = $productList[$selectedProduct];
        ?>

        <div class="banner-container"> 
            <img class="shop-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type; ?>-list-banner.png"
                alt="<?php echo $currentProduct->infos->type ?> list banner">
            <h1 class="banner-title">NOS <span class="orange-highlight"><?php echo $currentProduct->infos->pluralName; ?></span></h1>
            <p class="banner-text">Découvrez notre sélection de <?php echo $currentProduct->infos->pluralName;?></p>
        </div>


        <div class="products-research-options-container">
                <div class="brand-research-container">
                    <h2 class="subtitle">Choisir une marque</h2>
                    <div class="brand-cards-container">
                        <?php
                            for($i = 0; $i < count($brands); $i++) {
                                $brandName = $brands[$i];
                                echo "<div class=\"brand-card\">
                                    <img class=\"".$brandName."-card-logo\" src=\"ressources/images/logos/logo-".$brandName.".png\" alt=\"".$brandName." logo\">
                                    <input type=\"checkbox\" id=\"".$brandName."-products\" name=\"brand-products\">
                                </div>";
                                }
                        ?>
                    </div>
                <h2 class="subtitle">Choisir un produit</h2>
            </div>

            <div class="scroll-list-container">
                <label for="product-select">Trier les produits</label>
                <select name="product" id="product-select">
                    <option value="ascending-price">Prix croissant</option>
                    <option value="decreasing-price ">Prix décroissant</option>
                </select>
            </div>
        </div>

        <div class="products-grid-container">
            <div class="products-line-container">
                <?php

                for($i = 0; $i < count($currentProduct->items); $i++){
                        $currentItem = $currentProduct->items[$i];
                        echo "<div class=\"product-card\">
                        <button <i class=\"fas fa-heart\"></i></button>

                        <img class=\"".$currentProduct->infos->type."\" src=\"".$currentItem->getImage()."\" alt=\"".$currentProduct->infos->type." picture\">

                        <div class=\"miniature-product-container\">
                            <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$currentProduct->infos->type.".png\"
                                alt=\"".$currentProduct->infos->type." picture\">
                                <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$currentProduct->infos->type.".png\"
                                alt=\"".$currentProduct->infos->type." picture\">
                        </div>
                        <h2 class=\"product-name\">".$currentItem->getTitle()."</h2>
                        <p class=\"product-price\">".$currentItem->getPrice()."€</p>
                        <a class=\"red-button\" href=\"article.php?produit=$selectedProduct\"><p class=\"button-content\">Découvrir</p></a>
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