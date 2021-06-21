<?php
DEFINE("ROOT_PATH", dirname(__FILE__) . "/");
require_once(ROOT_PATH . "services/authentificationManager.php");
require_once(ROOT_PATH . "services/pdo.php");
require_once(ROOT_PATH . "services/pdoManager.php");

session_start();
if (isset($_SESSION["user"])) {
    header("Location: profile.php");
    exit;
}

$registerSuccess = true;
$loginSuccess = true;
if (!empty($_POST)) {
    switch ($_POST["action"]) {
        case "register":
            $registerSuccess = Authentication::register($_POST["nickname"], $_POST["email"], $_POST["password"]);
            break;

        case "login":
            $loginSuccess = Authentication::login($_POST["connexion-email"], $_POST["connexion-password"]);
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
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png" />
    <title>Inscription</title>
</head>

<body>
    <?php
    include(ROOT_PATH . "layout/header.php");
    ?>

    <div id="main-container">
        <section class="form-container subscription">
            <div class="form-header-container">
                <h2>Rejoignez le <span class="orange-highlight">mouvement</span></h2>
                <div class="separator-container">
                    <div class="orange-horizontal-line"></div>
                </div>
                <?php
                if (!$registerSuccess) {
                    echo "<p class=\"red-highlight\">L'adresse et/ou le mot de passe sont incorrects</p>";
                }
                ?>
            </div>

            <form class="form" action="#" method="POST">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="nickname" id="pseudo">

                <label for="mail">Adresse email</label>
                <input <?php if (!$registerSuccess) echo "class=\"red-borders\""; ?> type="email" name="email" id="mail">

                <label for="pass">Mot de passe</label>
                <input <?php if (!$registerSuccess) echo "class=\"red-borders\""; ?> type="password" name="password" id="pass">

                <div class="GDPR-verification-container">
                    <input class="checkbox" type="checkbox" id="grpr-verification" name="gdpr-verification" required>
                    <label for="grpr-verification">j'ai lu et j'accepte les <a href="gdpr.php">termes</a> et conditions</label>
                </div>

                <input type="hidden" name="action" value="register">

                <button type="submit">S'enregistrer</button>
            </form>
        </section>

        <section class="form-container login">
            <div class="form-header-container">
                <h2>Bon <span class="orange-highlight">retour</span> parmi nous</h2>
                <div class="separator-container">
                    <div class="orange-horizontal-line"></div>
                </div>
                <?php
                if (!$loginSuccess) {
                    echo "<p class=\"red-highlight\">L'adresse et/ou le mot de passe sont incorrects</p>";
                }
                ?>
            </div>

            <form class="form" action="#" method="POST">
                <label for="connexion-mail">Adresse email</label>
                <input <?php if (!$loginSuccess) echo "class=\"red-borders\""; ?> type="email" name="connexion-email" id="connexion-mail">

                <label for="connexion-pass">Mot de passe</label>
                <input <?php if (!$loginSuccess) echo "class=\"red-borders\""; ?> type="password" name="connexion-password" id="connexion-pass">

                <input type="hidden" name="action" value="login">

                <button type="submit">Se connecter</button>
            </form>
        </section>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="panel-message"><span class="orange-highlight">BON RETOUR</span>PARMI NOUS !</h1>
                    <p class="subtitle">Garde le rythme en toute circonstance</p>
                    <button class="overlay-button" id="signIn" class="ghost">
                        Se connecter
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="panel-message"><span class="orange-highlight">NOUVEL</span> UTILISATEUR ?</h1>
                    <p class="subtitle">Rejoins une communauté fantastique présente à travers le monde entier</p>
                    <button class="overlay-button" id="signUp" class="ghost">
                        S'enregistrer
                    </button>
                </div>
            </div>
        </div>

    </div>


    <?php
    include(ROOT_PATH . "layout/footer.php");
    ?>
    <script type="text/javascript" src="ressources/scripts/login.js"></script>
</body>

</html>