<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ressources/css/watches-shop.css" type="text/css" />
        <title>Brassards Runzik</title>
    </head>

    <body>

        <?php
        include("layout/header.php");
        ?>

        <div class="banner-container">
            <?php
            $armband= "armband";

            ?>
            <img id=.<?php $armband ?> class="<watches-shop-banner"
                src="ressources/images/banners/watches-shop-banner.png" alt="watches shop banner">
            <h1 class="banner-title">NOS <span class="orange-highlight">MONTRES</span></h1>
            <p class="banner-text">Découvrez notre sélection de brassards</p>
        </div>

        <?php
        if(isset($watch)){
            $product = $watch;
            $screenDisplayName = "Montre";
        } elseif (isset($armband)){
            $product = $armband;
            $screenDisplayName = "Brassard";
        } elseif(isset($headphone)){
            $product = $headphone;
            $screenDisplayName = "Casque";
        }
        ?>

        <?php
        include("layout/products-shop-content.php");
        ?>

        <?php
        include("layout/footer.php");
        ?>
    </body>

</html>