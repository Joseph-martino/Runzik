<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/pdo.php");
    session_start();
?>

<?php

var_dump($_SESSION["user"]);

if(!empty($_POST)) {
    if(isset($_POST["username"]) && !empty($_POST["username"])) {
        $pseudo = strip_tags($_POST["username"]);
        var_dump($_POST["username"]);
        $pdo = myPDO::getPDO();               
        $sql = "UPDATE `users` SET `username` = ':pseudo' WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
        $query = $pdo->prepare($sql); 
        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->execute();
        var_dump($query);
        var_dump($_SESSION["user"]);
        $_SESSION["user"]["pseudo"] = $pseudo;
    }

        // $pdo = myPDO::getPDO();               
        // $sql = "UPDATE `users` SET `username` = '".$_POST["username"]."' WHERE `users`.`id` = ".$_SESSION["user"]["id"]."";
        // $query = $pdo->prepare($sql); 
        // $query->execute();
        // var_dump($query);

        // $pdo = myPDO::getPDO();
        // $sql = "SELECT * FROM `users` WHERE `email` = :email";
        // $query = $pdo->prepare($sql);
        // $query->bindValue(":email", $_POST["connexion-email"], PDO::PARAM_STR);
        // $query->execute();
        // $user = $query->fetch();
  

}
        
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

        <?php
            include(ROOT_PATH ."layout/header.php");
        ?>

<h1><?php echo $_SESSION["user"]["pseudo"]?></h1>

<section>
    <div class="account-informations">
        <img src="" alt="informations-icon">
        <h2>Informations générales</h2>
    </div>

    <div>
        <p>Nom:</p>
        <p>Prénom</p>
        <p>Adresse mail</p>
        <p>Mot de passe:</p>
    </div>

    <div>
        <p><?php echo $_SESSION["user"]["pseudo"] ?></p>
        <p><?php echo $_SESSION["user"]["email"] ?></p>
    </div>

    <form action="#" method="POST">
        <input type="text" name="username">
        <button type="submit">Modifier</button>
    </form>



</section>
    
</body>
</html>