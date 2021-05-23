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
    <title>Inscription</title>
</head>
<body>
        <?php
            include( ROOT_PATH . "layout/header.php");
        ?>

        <div class="main-container">
            <section class="subscription">
                <div>
                    <h2>Rejoignez le <span>mouvement</span></h2>
                    <div class="orange-horizontal-line"></div>
                </div>

                <form action="#" method="POST">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="nickname" id="pseudo">

                    <label for="mail">Adresse email</label>
                    <input type="email" name="email" id="mail">

                    <label for="pass">Mot de passe</label>
                    <input type="password" name="password" id="pass">

                    <input type="hidden" name="action" value="register">

                    <button type="submit">S'enregistrer</button>
                </form>
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