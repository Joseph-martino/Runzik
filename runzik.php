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
            <h1 class="main-title">Comment <span class="orange-highlight">l'aventure</span> à 
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
                <img class="panel-icon" src="ressources/images//icons/brand-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <div class="information-panel">
                <h2>Lorem ipsum dolor</h2>
                <img class="panel-icon" src="ressources/images//icons/brand-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <div class="information-panel">
                <h2>Lorem ipsum dolor</h2>
                <img class="panel-icon" src="ressources/images//icons/brand-icon.png">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>

        <section class="first-section-container">
            <div class="first-section-text-container">
                <h2>Lorem <span class="pink-highlight">ipsum</span> dolor sit amet, consectetur adipiscing elit. Id lacus 
                <span class="pink-highlight">mi blandit.</span></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. 
                    Amet, a lorem augue aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, 
                    volutpat nunc justo pulvinar tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.Lorem ipsum 
                    dolor sit amet, consectetur adipiscing elit. Id lacus mi blandit faucibus tincidunt sed. Amet, a lorem augue 
                    aliquam commodo turpis id. Dictum non aliquam lobortis molestie volutpat. Sagittis, volutpat nunc justo pulvinar 
                    tincidunt duis. Sit nunc sed vulputate aliquam, a blandit magna.
                </p>
            </div>
            <div>
                <img class="character-picture" src="ressources/images/photos/man-using-watch.png" alt="man who is looking his watch">
                <img class="smoke-effect-picture" src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
            </div>
        </section>

        <section class="first-section-container">
            <div>
                <img src="ressources/images/photos/man-using-watch.png" alt="man who is looking his watch">
                <img src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
            </div>

            <div>
                <h2>Lorem ipsum</h2>
                <img src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
            </div>

            <div>
                <img src="ressources/images/photos/man-using-watch.png" alt="man who is looking his watch">
                <img src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
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
        </section>

        <section>
            <h2>Lorem ipsum dolor sit amet</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id lacus mi blandi</p>
            <div>
                <img src="ressources/images/photos/man-using-watch.png" alt="man who is looking his watch">
                <img src="ressources/images/photos/smoke-effect.png" alt="smoke effect">
            </div>
        </section>
        <?php
        include(ROOT_PATH ."layout/footer.php");
        ?>
    </body>
</html>