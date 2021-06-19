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
    <link rel="stylesheet" href="ressources/css/qfa.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Foire aux questions</title>
</head>
<body>

    <?php
        include(ROOT_PATH ."layout/mobileHeader.php");
    ?>
    <section class="banner-container"> 
        <img class="main-page-banner" src="ressources/images/banners/faq-banner.png"
            alt=" main page banner">
        <h1 class="banner-title">FOIRE AUX<span class="orange-highlight"> QUESTIONS</span></h1>
        <div class="header-container">
            <?php
                include( ROOT_PATH . "layout/header.php");
            ?>
        </div>
    </section>

    <section class="main-content">
        <div class="content-header">
            <div class="horizontal-separator"></div>
            <h2>VOUS AVEZ DES QUESTIONS ?</h2>
            <div class="horizontal-separator"></div>
        </div>
        <div class="explanations-container-grid">
                <div class="explanation-container">
                    <img class="explanation-icon" src="ressources/images/icons/product-back-icon.png" 
                    alt="icon for sending back a product">
                    <h3>Retour</h3>
                    <div class="text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis 
                            sit donec parturient neque at tempus. Eget felis lorem cursus dignissim id 
                            at facilisis enim.
                        </p>
                    </div>
                    
                </div>

                <div class="explanation-container">
                    <img class="explanation-icon" src="ressources/images/icons/shipping-cost-icon.png" 
                    alt="icon for sending back a product">
                    <h3>Frais de port</h3>
                    <div class="text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis 
                            sit donec parturient neque at tempus. Eget felis lorem cursus dignissim id 
                            at facilisis enim.
                        </p>
                    </div>
                </div>

                <div class="explanation-container">
                    <img class="explanation-icon" src="ressources/images/icons/garantee-icon.png" 
                    alt="icon for sending back a product">
                    <h3>Satisfait ou remboursé</h3>
                    <div class="text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis 
                            sit donec parturient neque at tempus. Eget felis lorem cursus dignissim id 
                            at facilisis enim.
                        </p>
                    </div>
                </div>

                <div class="explanation-container">
                    <img class="explanation-icon" src="ressources/images/icons/delivery-icon.png" 
                    alt="icon for sending back a product">
                    <h3>Livraison</h3>
                    <div class="text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis 
                            sit donec parturient neque at tempus. Eget felis lorem cursus dignissim id 
                            at facilisis enim.
                        </p>
                    </div>
                </div>
        </div>
    </section>
    <?php
        include( ROOT_PATH . "layout/footer.php");
    ?>


    
</body>
</html>