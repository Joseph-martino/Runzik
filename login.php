<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
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
                if(isset($_POST["nickname"], $_POST["email"], $_POST["password"])
                && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["password"])
                ) {
                    $pseudo = strip_tags($_POST["nickname"]);
                  
                    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" , $_POST["email"])) {
                        // ajouter PDO
                        $pdo = myPDO::getPDO();

                        $sql = "SELECT COUNT(*) FROM users WHERE email = '".$_POST["email"]."'";
                        $query = $pdo->prepare($sql);
                        $query->execute();
                        var_dump($query);
                        var_dump($_POST["email"]);
                        if($query) {
                            echo "l'adresse existe déjà";
        
                        } else {
                            echo "l'adresse est correcte";
                        }
                    }
                        
                    if(preg_match("#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$#", $_POST["password"])){
                        echo "mot de passe correct";
                    } else {
                        echo "Entrez un mot de passe de 8 à 15 caractères comprenant au moins: une minuscule, une majuscule, un chiffre et un caractère -+!*$@%_";
                    }
        
                        $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
                        echo $pass;
                    
                        $pdo = myPDO::getPDO();
                            
                        $sql = "INSERT INTO `users` (`username`,`email`, `password`, `isAdmin`) VALUES (:pseudo, :email, '$pass', false)";
                        $query = $pdo->prepare($sql);
                        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
                        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                        $query->execute();

                        $id = $pdo->lastInsertId();

                        $_SESSION["user"] = [
                            "id" => $id,
                            "pseudo" => $pseudo,
                            "email" => $_POST["email"],
                            "isAdmin" => false
                        ];
                    header("Location: profile.php");
                       echo "Bienvenue ".$_SESSION["user"]["pseudo"];
        
                } else {
                    die("Le formulaire est incomplet");
                }

            break;

            case "login":
                session_start();
                if(!empty($_POST)){
                    if(isset($_POST["connexion-email"], $_POST["connexion-password"])
                    && !empty($_POST["connexion-email"] && !empty($_POST["connexion-password"]))) 
                    {
                        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" , $_POST["connexion-email"])) {
                            echo "email correcte";
                        } else {
                            die ("Ce n'est pas un email");
                        }
        
                        $pdo = myPDO::getPDO();
                        $sql = "SELECT * FROM `users` WHERE `email` = :email";
                        $query = $pdo->prepare($sql);
                        $query->bindValue(":email", $_POST["connexion-email"], PDO::PARAM_STR);
                        $query->execute();
                        $user = $query->fetch();
                        if(!$user){
                            die("L'utilisateur et/ou le mot de passe est incorrect");
                        }
                        if(!password_verify($_POST["connexion-password"], $user["password"])){
                            die("L'utilisateur et/ou le mot de passe est incorrect");
                        }
                        
                        $_SESSION["user"] = [
                            "id" => $user["id"],
                            "pseudo" => $user["username"],
                            "email" => $user["email"],
                            "isAdmin" => $user["isAdmin"]
                        ];
                    header("Location: profile.php");
                    echo "Bienvenue ".$_SESSION["user"]["pseudo"];
                    }
                    break;
                }  
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