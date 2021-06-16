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
        <link rel="stylesheet" href="ressources/css/runzik.css" type="text/css" />
        <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
        <title>Runzik</title>
    </head>

    <body>
        <?php
            include(ROOT_PATH ."layout/mobileHeader.php");
        ?>

        <div class="banner-container">
            <img class="brand-banner" src="ressources/images/banners/brand-banner.png" alt="brand-banner">
            <h1 class="main-title">Comment <span class="orange-highlight">l'aventure</span> a 
                <span class="orange-highlight"> commencé</span>
            </h1>
            <div class="header-container">
                <?php
                    include(ROOT_PATH ."layout/header.php");
                ?>
            </div>
        </div>

        <div class="informations-panels-container">
            <div class="information-panel">
                <h2>Lorem ipsum dolor</h2>
                <img class="panel-icon" src="ressources/images//icons/brand-quality-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <div class="information-panel">
                <h2>Lorem ipsum dolor</h2>
                <img class="panel-icon" src="ressources/images//icons/brand-run-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <div class="information-panel">
                <h2>Lorem ipsum dolor</h2>
                <img class="panel-icon" src="ressources/images//icons/brand-music-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>

        <section class="first-section-container">
            <div class="first-section-text-container">
                <h2>Lorem <span class="pink-highlight">ipsum</span> dolor sit amet, consectetur adipiscing elit. Id lacus 
                <span class="pink-highlight">mi blandit.</span></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. 
                    Amet, a lorem augue aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, 
                    volutpat nunc justo pulvinar tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.
                </p>
                    
                <p class="first-section-desktop-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. Amet, a lorem augue 
                    aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, volutpat nunc justo pulvinar 
                    tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.
                </p>
            </div>
            <div class="first-section-pictures-container">
                <img class="character-picture" src="ressources/images/photos/man-using-watch.png" alt="man who is looking his watch">
                <img class="smoke-effect-picture" src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
            </div>
        </section>

        <section class="second-section-container">
            <div class="second-section-content-container">
                <div class="second-section-first-column">
                    <img class="mobile-hidden-pictures" src="ressources/images/photos/shoes.png" alt="shoes">
                    <img class="running-woman-picture" src="ressources/images/photos/running-woman.png" alt="running woman">
                </div>

                <div class="second-section-second-column mobile-hidden-pictures">
                    <h2><span class="pink-highlight">Lorem</span> ipsum dolor</h2>
                    <img src="ressources/images/photos/running-man" alt="running man">
                </div>

                <div class="second-section-third-column">
                    <img class="man-in-starting-position-picture mobile-hidden-pictures" src="ressources/images/photos/man-in-starting-position-ready-to-start.png" alt="man in starting position ready to start">
                    <img  class="man-and-woman-in-starting-position-picture mobile-hidden-pictures" src="ressources/images/photos/man-and-woman-in-starting-position.png" alt="man and woman in starting position">
                    <div class="second-section-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus 
                            tincidunt sed. Amet, a lorem augue aliquam commodo turpis id. Dictum non aliquam 
                            lobortis molestie volutpat. Sagittis, volutpat nunc justo pulvinar tincidunt duis. 
                            Sit nunc sed vulputate aliquam, a blandit magna.
                        </p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus 
                            tincidunt sed. Amet, a lorem augue aliquam commodo turpis id. Dictum non aliquam 
                            lobortis molestie volutpat. Sagittis, volutpat nunc justo pulvinar tincidunt duis. 
                            Sit nunc sed vulputate aliquam, a blandit magna.
                        </p>
                    </div>  
                </div>
            </div>
        </section>

        <section  class="third-section-container">
            <div class="third-section-text-content-container">
                <h2><span class="pink-highlight">Lorem</span> ipsum <span class="pink-highlight">dolor</span> sit amet</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. Amet, 
                    a lorem augue aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, volutpat 
                    nunc justo pulvinar tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.
                </p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. Amet, 
                    a lorem augue aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, volutpat 
                    nunc justo pulvinar tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.
                </p>
            </div>
            

            <div class="third-section-pictures-container">
                <img src="ressources/images/photos/founder1.png" alt="happy man who found the company">
                <img src="ressources/images/photos/founder2.png" alt="happy man who found the company">
            </div>
        </section>
        <?php
        include(ROOT_PATH ."layout/footer.php");
        ?>
    </body>
</html>