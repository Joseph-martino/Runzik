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
    <link rel="stylesheet" href="ressources/css/contact.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Contact</title>
</head>
    <body>

        <?php
            include(ROOT_PATH ."layout/header.php");
            include(ROOT_PATH ."layout/mobileHeader.php");
        ?>
    
        <div class="main-container">
            <section class="left-panel">
                <h1>On se tient au <span class="orange-highlight">courant</span></h1>
            </section>

            <section class="right-panel">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Une <span class="orange-highlight">question</span>
                            ? Besoin d' <span class="orange-highlight">aide</span>
                            ? C'est par <span class="orange-highlight">ici</span>
                        </h2>
                    </div>

                    <div class="form-wrapper">
                        <form  class="form" action="#" method="POST">
                            <label for="name">Nom</label>
                            <input id ="name" class="input-field" type="text" name="familyName">

                            <label for="firstname">Prénom</label>
                            <input id ="firstname" class="input-field" type="text" name="firstName">

                            <label for="email">Email</label>
                            <input id ="email" class="input-field" type="email" name="email">

                            <label for="message">Message</label>
                            <textarea name="message" class="input-field" id="message" cols="30" rows="10"></textarea>

                            <div class="GDPR-verification-container">
                                <input class="checkbox" type="checkbox" id="grpr-verification" name="gdpr-verification" required>
                                <label class="grpd-message" for="grpr-verification">j'ai lu et j'accepte les <a class="gdpr-link" href="gdpr.php">termes</a> et <a class="gdpr-link" href="gdpr.php#standard-form-contract">conditions</a></label>
                            </div>

                            <button type="submit">Envoyer</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php
            include(ROOT_PATH ."layout/footer.php");
        ?>
    </body>
</html>