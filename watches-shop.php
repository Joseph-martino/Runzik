<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ressources/css/watches-shop.css" type="text/css" />
        <title>Montres Runzik</title>
    </head>

    <body>

        <?php
        include("layout/header.php");
        ?>

        <div class="banner-container">
            <img class="watches-shop-banner" src="ressources/images/banners/watches-shop-banner.png"
                alt="watches shop banner">
            <h1 class="banner-title">NOS<span class="orange-highlight">MONTRES</span></h1>
            <p class="banner-text">Découvrez notre sélection de brassards</p>
        </div>

        <div class="products-research-options-container">
            <div class="brand-research-container">
                <h2 class="subtitle">Choisir une marque</h2>
                <div class="brand-cards-container">
                    <?php
                    for($i = 0; $i <3; $i++) {
                        $brandName;
                        switch ($i) {
                            case 0:
                                $brandName="runzik";
                                break;
                            case 1:
                                $brandName="beats";
                                break;
                            case 2:
                                $brandName="jbl";
                                break;
                        }
                        echo "<div class=\"brand-card\">
                        <img class=\"".$brandName."-card-logo\" src=\"ressources/images/logos/logo-".$brandName.".png\" alt=\"".$brandName." logo\">
                        <input type=\"checkbox\" id=\"".$brandName."-products\" name=\"".$brandName."-products\">
                    </div>";
                    }
                    ?>

                </div>
                <h2 class="subtitle">Choisir un produit</h2>
            </div>
            <div class="scroll-list-container">
                <label for="product-select">Trier les produits</label>
                <select name="product" id="product-select">
                    <option value="ascending-price">Du + cher au - cher</option>
                    <option value="decreasing-price ">Du - cher au + cher</option>
                </select>
            </div>
        </div>
        <div class="products-grid-container">
            <div class="products-line-container">
                <?php
                 $index = 0;
                for($i = 0; $i < 6; $i++){
                    $index++;
                    if($index >3){
                        $index = 1;
                    }
                echo "<div class=\"product-card\">
                <button class=\"add-to-wishlist-button\"><img class=\"wishlist-icon\"
                        src=\"ressources/images/icons/add-to-wishlist-icon-selected.png\"
                        alt=\"add to wishlist icon\"></button>

                <img class=\"watch\" src=\"ressources/images/products/watch".$index.".png\" alt=\"watch picture\">

                <div class=\"miniature-product-container\">
                    <img class=\"miniature-product\" src=\"ressources/images/products/miniature-watch.png\"
                        alt=\"watch picture\">
                    <img class=\"miniature-product\" src=\"ressources/images/products/miniature-watch.png\"
                        alt=\"watch picture\">
                    <img class=\"miniature-product\" src=\"ressources/images/products/miniature-watch.png\"
                        alt=\"watch picture\">
                </div>
                <h2 class=\"product-name\">Montre Run’Zik S Plus</h2>
                <p class=\"product-price\">150€</p>
                <button class=\"see-more-button\">Découvrir</button>
            </div>";
            }
            ?>
            </div>
        </div>

        <?php
        include("layout/footer.php");
        ?>
    </body>

</html>