<?php 
DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ressources/css/style.css" type="text/css" />
        <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
        <title>Runzik</title>
    </head>

    <body>
        <section class="banner-container"> 
            <img class="main-page-banner" src="ressources/images/banners/main-page-banner.png"
                alt=" main page banner">
            <h1 class="banner-title">BOUGER PLUS VITE QUE LA MU’<span class="orange-highlight">ZIK</span></h1>
            <a class="banner-button" href="runzik.php">Rejoignez-nous</a>
            <div class="header-container">
                <?php
            include( ROOT_PATH . "layout/header.php");
        ?>
            </div>
        </section>

        <section class="new-releases">
            <div class="new-realeases-title">
                <h2 class="handwritten-font-effect medium-title">New track</h2>
                <h3 class="big-font">UPCOMING<span class="pink-highlight handwritten-font-effect medium-font"> Artist</span></h3>
                <h3 class="pink-highlight thin-font">The real time shady</h3>
                <div class="vertical-separator"></div>
            </div>
            

            <div class="sound-effect-picture">
                <img src="ressources/images/effects/sound-effect.png" alt="sound effect pattern">
            </div>
            
            <div class="last-releases-title-container">
                <h3 class="new-releases-label-title">New releases</h3>
                <div class="release-separator"></div>
            </div>
            

            <div class="new-trend-release-picture-container">
                <img src="ressources/images/products/trend-headphone.png" alt="headphone">
            </div>
            <div class="products-thumbnails-container"><!--probleme largeur-->
                <?php 
                    for($i = 0; $i < 4; $i++) {

                        echo "<div class=\"thumbnails-container\"><img class=\"new-trend-product-picture\"src=\"ressources/images/products/release-product".$i.".png\" alt=\"release product\"></div>";
                    }    
                ?>
                </div>

                <div class="mobile-thumbnails-products-container"><!--probleme largeur-->
                    <img class="mobile-new-trend-product-picture"src="ressources/images/products/release-product0.png" alt="release product">
                    <img class="mobile-new-trend-product-picture"src="ressources/images/products/release-product1.png" alt="release product">
                    <img class="mobile-new-trend-product-picture"src="ressources/images/products/release-product2.png" alt="release product">
                    <img class="mobile-new-trend-product-picture"src="ressources/images/products/release-product3.png" alt="release product">
                </div>
                
        </section>

        <section class="last-trends-container">
            <div class="last-trends-title-container">
                <h2>LES DERNIÈRES TENDANCES</h2>
            </div>
            
            <div class="trends-products-container"><!--probleme largeur-->
                <?php
                    for($i=0; $i < 3; $i++) {
                        echo "<div class=\"trend-product\">
                        <img class=\"trend-product-image\" src=\"ressources/images/products/trend".$i.".png\" alt=\"release product\">
                        <div class=\"trend-product-hidden-link-container\">
                        <h3 class=\"trend-product-name\">Product</h3>
                        <a class=\"red-button\" href=\"jbk\">Découvrir</a> 
                        </div> 
                        </div>";

                    }
                ?>
            </div>
        </section>

        <section class="stay-tune-section-container">
            <div class="picture-container">
                <img class="stay-tune-picture" src="ressources/images/photos/man-with-earphones" alt="man-with-earphones">
            </div>

            <div class="stay-tune-text-wrapper">
                <div class="stay-tune-text-container">
                    <h2 class="stay-tune-title">Restez connecté</h2>
                    <h3 class="stay-tune-title-subtitle">N'en <span class="pink-highlight">manquez</span> pas une <span class="pink-highlight">miette</span> </h3>
                    <div class="vertical-separator"></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi, magnis urna nunc pellentesque vitae. 
                        A tincidunt egestas nibh eleifend eget non, vulputate praesent. Orci sit in et elit urna volutpat.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi, magnis urna nunc pellentesque vitae. 
                        A tincidunt egestas nibh eleifend eget non, vulputate praesent. Orci sit in et elit urna volutpat.
                    </p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi, magnis urna nunc pellentesque vitae. 
                        A tincidunt egestas nibh eleifend eget non, vulputate praesent. Orci sit in et elit urna volutpat.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi, magnis urna nunc pellentesque vitae. 
                        A tincidunt egestas nibh eleifend eget non, vulputate praesent. Orci sit in et elit urna volutpat.
                    </p>
                </div>
            </div>
        </section>

        <?php
            include( ROOT_PATH . "layout/footer.php");
        ?>
        <script type="text/javascript" src="ressources/scripts/index.js"></script>
    </body>

</html>