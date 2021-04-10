<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/article.css" type="text/css" />
    <title>Montre</title>
    
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
            $selectedProductIndex = $_GET["index"];
            $currentProduct = $productList[$seletedProduct]->items[$selectedProductIndex];
        ?>

        <script>
            const productType = "<?php echo $selectedProduct ?>";
        </script>

        <div class="mobile-banner-container">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <img class="mobile-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-mobile-banner-font" alt="mobile-banner">
            <img class="mobile-<?php echo $currentProduct->infos->type ?>-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-mobile-banner" alt="<?php echo $currentProduct->infos->type ?>-banner">
            <div class="mobile-banner-title">
                <p class="product-name"><?php echo $currentProduct->infos->name ?> Run’Zik S Plus</p>
                <p class="product-description">Profitez pleinement de vos sorties sportives</p>
                <p class="product-price"><?php echo $currentProduct->infos->price ?>€</p>
            </div>   
        </div>
        
        <div class="banner-container">
            <img class="desktop-page-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-banner-background" alt="product banner">
            <img id ="banner-product" class="banner-product" src="ressources/images/banners/banner-<?php echo $currentProduct->infos->type ?>" alt="banner-<?php echo $currentProduct->infos->type ?>">
            <div class=banner-title>
                <h1><?php echo $currentProduct->infos->name ?> Run’Zik S Plus</h1>
                <p class="product-description">Profitez pleinement de vos sorties sportives</p>
                <p class="price"><?php echo $currentProduct->infos->price ?>€</p>
            </div>
            
            
            <div class="colours-choices-container">
                <p>Coloris</p>
                <form action="#" method="POST">
                <?php
                
                    for($i = 0; $i < 2; $i++){
                        $radioId;
                        $radioValue;
                        switch($i) {
                            case 0:
                                $radioId = $i;
                                $radioValue = $currentProduct->infos->colours[0];
                                break;
                            case 1:
                                $radioId = $i;
                                $radioValue = $currentProduct->infos->colours[1];
                                break;                 
                        }
                        echo "<input type=\"radio\" id=\"".$radioId."\" name=\"product-colour\" value=\"".$radioValue."\">
                        <label for=\"".$radioId."\"></label>";
                    }
                    
                ?>
   
                        <input class="quantity-input-container" type="number" id="quantity" name="product-quantity">
                        <label for="quantity"></label>
                        <p id="product-colour-text"></p>
                   
                    <div class="add-to-cart-button-container">
                    <input class="blue-button" type="submit" value="Ajouter au panier">

                    </div>
                    
                </form>
            </div>           
        </div>

        <section class="product-informations-container">
            <img class="product-information-picture" src="ressources/images/photos/<?php echo $currentProduct->infos->type ?>-product-side-picture" alt="sitting man picture">
            <div class="informations-container">
                <div class="section-title">
                    <h2>INFORMATIONS PRODUIT</h2>
                </div>

                <div class="mobile-information-text-container">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat morbi faucibus mattis sollicitudin malesuada sed et in. 
                    In sed amet, nibh cursus ac tellus porttitor at. Quam ac tortor pretium nibh sagittis sit id pretium.
                    </p>

                </div>

                <div class="product-informations-text-container">

                <?php
                for($i = 0; $i<4; $i++){
                    echo "<div class=\"product-informations-content\">
                            <div class=\"product-informations-content-subtitle\">
                                <img class=\"checkmark\" src=\"ressources/images/icons/checkmark.png\" alt=\"checkmark icon\">
                                <h3>Titre</h3>
                            </div>
                            <p class=\"white-text\">Lorem ipsum dolor sit amet, <span class=\"orange-highlight\">consectetur</span> adipiscing elit. <span class=\"orange-highlight\">Lorem ipsum dolor sit amet</span> , consectetur adipiscing elit.</p>
                        </div>";
                }
                ?>
                </div>
            </div>
        </section>

        

        <section class="feature-section">
            <div class="section-title">
                <h2>DETAILS TECHNIQUES</h2>
            </div>
            <div class="product-features-container">
                <?php
                for($i = 0; $i < 6; $i++){
                    $featureName;
                    $numberBox;
                                switch ($i) {
                                    case 0:
                                        $featureName ="phone";
                                        break;
                                    case 1: 
                                        $featureName ="music";
                                        break;
                                    case 2:
                                        $featureName ="bluetooth";
                                        break;
                                    case 3:
                                        $featureName ="heart-with-pulse";
                                        break;
                                    case 4: 
                                        $featureName ="meteo";
                                        break;
                                    case 5:
                                        $featureName ="location";
                                    break;
                                }

                                if($i %2  === 0){
                                    $numberBox = "even-numbers-box";

                                } else {
                                    $numberBox = "odd-numbers-box";
                                    
                                }
                                     
                            echo "<div class=\"feature-container ".$numberBox."\">
                                    <img class=\"feature-icon\" src=\"ressources/images/icons/".$featureName."-icon.png\" alt=\"".$featureName." icon\">
                                    <h3>Lorem ipsum</h3>
                                    <p class=\"white-text\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis sit donec parturient neque at tempus. 
                                    Eget felis lorem cursus dignissim id at facilisis enim.</p>
                                </div>";
                }
                ?>
            </div>
        </section>

        <img class="second-banner"src="ressources/images/products/<?php echo $currentProduct->infos->type ?>-article-picture.png" alt="<?php echo $currentProduct->infos->type ?>">

        
        <section class="technology-container">
            <div class="section-title">
                <h2>NOTRE TECHNOLOGIE</h2>
            </div>
            <div class="technology-explanations-container">
                <div class="technology-text">
                <h3>TECHNOLOGIE : L'OSTÉOPHONIE OU CONDUCTION OSSEUSE</h3>
                <p>
                Ce casque ouvert vous permet de téléphoner ou d’écouter votre MP3 et les bruits autour de vous. 
                Le casque Run’Zik dispose de 2 transducteurs qui émettent des mini vibrations qui passent par les 
                os des pommettes et des joues pour arriver directement à la cochlée (l’oreille interne). 
                Vous avez les oreilles libres ; rien ne les bouche ou ne les recouvre
                </p>
                </div>
               <div class="desktop-pictures-container">
               <div class="technology-pictures-container">
                    <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                    <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                    <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                </div>

               </div>
            
            </div>
            <img class="product-picture"src="ressources/images/products/<?php echo $currentProduct->infos->pluralName ?>.png" alt="<?php echo $currentProduct->infos->pluralName ?>">
        </section>

        <!-- <div class="mobile-add-to-cart-menu">
            <input class="mobile-quantity-input-container" type="number" id="quantity" name="product-quantity">
            <label for="quantity"></label>
                   
            <div class="mobile-add-to-cart-button-container">
            <input class="blue-button" type="submit" value="Ajouter au panier">

        </div> -->
        <script type="text/javascript" src="ressources/scripts/article.js"></script>
    </body>
</html>