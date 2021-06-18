<?php   
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/AdminManager.php"); 

    session_start();
    if(!isset($_SESSION["user"]["isAdmin"])){
        header("Location: profile.php");
        exit;
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/editUser.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Modification utilisateur</title>
</head>
<body>


    <?php
        include(ROOT_PATH ."layout/header.php");
        include(ROOT_PATH ."layout/mobileHeader.php");

        $currentUserId = $_GET["userid"];
        $currentUser = AdminManager::getUser($currentUserId);
        $role = $currentUser->getRole(); 
        $checked = $role == 1 ? "checked" : "";
    ?>
        <section>
            <div class="title-container">
                <h2><?php echo $currentUser->getUsername() ?></h2>
            </div>

  
            <?php
            
                if(isset($_POST["user-update"])){
                    if(isset($_POST["user-username"], $_POST["user-email"]) 
                    && !empty($_POST["user-username"]) && !empty($_POST["user-email"])){
                        $username = $_POST["user-username"];
                        $email = $_POST["user-email"];
                        $isAdmin = isset($_POST["user-isAdmin"]) ? true : false;
                        $userId = $_POST["user-id"];
                        AdminManager::updateUser($username, $email, $isAdmin, $userId);
                        echo "<meta http-equiv='refresh' content='0'>";
                        
                    }
                }
            
            
            ?>
            <div class="main-content-container">
                <div class="form-container">
                    <form action="#" method="POST">
                        <div class="label-container">
                            <input type="hidden" name="user-id" value="<?php echo $currentUser->getId()?>">
                            <img src="ressources/images/icons/my-account-icon.png" alt="character icon">
                            <label for="user-username">Nom de l'utilisateur</label>
                        </div>
                        <input type="text" id="user-username" name="user-username" value="<?php echo $currentUser->getUsername()?>">
                        

                        <div class="label-container">
                            <img src="ressources/images/icons/mail-icon.png" alt="character icon">
                            <label for="user-email">Email de l'utilisateur</label>
                        </div>
                        <input type="email" id="user-email" name="user-email" value="<?php echo $currentUser->getEmail()?>">

                        <div class="label-container">
                            <img src="ressources/images/icons/admin-rights-icon.png" alt="character icon">
                            <label for="isAdmin-input">Droits d'administration</label>
                        </div>
                        <input type="checkbox" id="isAdmin-input" name="user-isAdmin" <?php echo $checked ?>>

                        <div class="buttons-container">
                            <button type="submit" name="user-update">Valider les changements</button>
                            <a class="btn-back-to-dashboard" href="admin.php">Retour au tableau de bord</a>
                        </div>
                        
                    </form>
                </div>
                
                <img src="ressources/images/photos/admin-edit-user-picture.png" alt="woman running picture">
            </div>
        </section>
        <?php
            include( ROOT_PATH . "layout/footer.php");
        ?>
    

    
</body>
</html>