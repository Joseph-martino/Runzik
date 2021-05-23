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
        <title>Document</title>
    </head>

    <body>

        <?php
            include( ROOT_PATH . "layout/header.php");
        ?>

        <section class="banner-container"> 
            <img class="main-page-banner" src="ressources/images/banners/main-page-banner.png"
                alt=" main page banner">
            <h1 class="banner-title">BOUGER PLUS VITE QUE LA MU’<span class="orange-highlight">ZIK</span></h1>
            <a class="banner-button" href="runzik.php">Rejoignez-nous</a>
        </section>

        <section class="new-releases">
            <div class="new-realeases-title">
                <h2 class="handwritten-font-effect">New track</h2>
                <h3>UPCOMING<span class="pink-highlight handwritten-font-effect">Artist</span></h3>
                <h3 class="pink-highlight">The real time shady</h3>
            </div>
            <div class="vertical-separator"></div>

            <div class="sound-effect-picture">
                <img src="ressources/images/effects/sound-effect.png" alt="sound effect pattern">
            </div>
            

            <h3>New releases</h3>
            <div class="vertical-separator"></div>

            <div class="new-trend-release">
                <img src="ressources/images/products/trend-headphone.png" alt="headphone">
            </div>
            <div class="products-thumbnails-container">
            <?php 
                for($i = 0; $i < 4; $i++) {
                    echo "<img src=\"ressources/images/products/release-product".$i.".png\" alt=\"release product\">";
                }    
            ?>
            </div>
        </section>

        <section class="last-trends-container">
            <h2>LES DERNIÈRES TENDANCES</h2>
            <div class="trends-products-container">
                <?php
                    for($i=0; $i < 3; $i++) {
                        echo "<div class=\"trend-product\">
                        <img src=\"ressources/images/products/trend".$i.".png\" alt=\"release product\">
                        <h3 class=\"trend-product-name\">Product</h3>
                        <a class=\"red-button\" href=\"jbk\">Découvrir</a>  
                        </div>";

                    }
                ?>
            </div>
        </section>

        <section class="stay-tune-section-container">
            <div class="picture-container">
                <img src="ressources/images/photos/man-with-earphones" alt="man-with-earphones">
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
        
    </body>

</html>