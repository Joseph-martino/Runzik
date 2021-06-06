<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/authentificationManager.php");
    require_once(ROOT_PATH ."services/pdo.php");
    require_once(ROOT_PATH ."services/pdoManager.php");

    session_start();
    if(isset($_SESSION["user"])){
        header("Location: profile.php");
        exit;
    }

    if(!empty($_POST)) {
        switch($_POST["action"]) {
            case "register": 
                Authentication::register($_POST["nickname"], $_POST["email"], $_POST["password"]);
            break;

            case "login":
                Authentication::login($_POST["connexion-email"], $_POST["connexion-password"]);
            break;       
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/login.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Inscription</title>
</head>
<body>
        <?php
            include( ROOT_PATH . "layout/header.php");
        ?>

        <div class="main-container">
            <section class="subscription">
                <div class="subscription-content-container">
                    <div class="form-header-container">
                        <h2>Rejoignez le <span class="orange-highlight">mouvement</span></h2>
                        <div class="separator-container">
                            <div class="orange-horizontal-line"></div>
                        </div>
                    </div>

                    <form action="#" method="POST">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="nickname" id="pseudo">

                        <label for="mail">Adresse email</label>
                        <input type="email" name="email" id="mail">

                        <label for="pass">Mot de passe</label>
                        <input type="password" name="password" id="pass">

                        <div class="GDPR-verification-container">
                            <input class="checkbox" type="checkbox" id="grpr-verification" name="gdpr-verification" required>
                            <label for="grpr-verification">j'ai lu et j'accepte les termes et conditions</label>
                        </div>

                        <input type="hidden" name="action" value="register">

                        <button type="submit">S'enregistrer</button>
                    </form>
                </div>
                <div class="register-separator-container">
                    <div class="white-separator"></div>
                    <div>
                        <p>OU</p>
                    </div>
                    <div class="white-separator"></div>
                </div>

                <div class="social-network-register">
                    <h3>Connectez-vous avec</h3>
                    <div class="social-network-icons-container">
                        <img src="ressources/images//icons/register-facebook-icon.png" alt="Facebook icon">
                        <img src="ressources/images//icons/register-google-icon.png" alt="Google icon">
                        <img src="ressources/images//icons/register-twitter-icon.png" alt="Twitter icon">
                    </div>
                </div>

            
                
            </section>

            <section class="login">
                <form action="#" method="POST">
                    <label for="connexion-mail">Adresse email</label>
                    <input type="email" name="connexion-email" id="connexion-mail">

                    <label for="connexion-pass">Mot de passe</label>
                    <input type="password" name ="connexion-password" id="connexion-pass">

                    <input type="hidden" name="action" value="login">

                    <button type="submit">Se connecter</button>
                </form>
            </section>
        </div>
    </body>
</html>