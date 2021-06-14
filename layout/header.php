<?php 
    require_once(ROOT_PATH ."services/productTypeManager.php");

    $types = ProductTypeManager::getProductTypes();
?>

    <div class="desktop-menu">
        <div class="logo-container">
            <a href="index.php"><img src="ressources/images/logos/logo-runzik.png" alt="Runzik Logo"></a>
        </div>

        <div class="tabs-menu">
            <nav class="navbar">
                <ul class=menu-links-list>
                    <li><a href="runzik.php">La marque</a></li>
                    <li><a href="#">La boutique</a>
                        <ul class="submenu">
                        <?php 
                            
                            for($i = 0; $i < count($types); $i++) {
                                $type = $types[$i];
                                echo "
                                <li><a class=\"dropdown-link\" href=\"shop.php?product=".$type->type."\">".$type->pluralName."</a></li>
                                ";
                                }
                        ?>
                        </ul>
                
                
                </li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>

            <?php if(!isset($_SESSION["user"])): ?>
            <a href="login.php"><img class="menu-icon" src="ressources/images/icons/login-icon.png"
                    alt="login icon"></a>

            <?php else: ?>
                <a href="profile.php"><img class="menu-icon" src="ressources/images/icons/logged-in-profile-icon.png" alt="logout icon"></a>
                <a href="logout.php"><img class="menu-icon" src="ressources/images/icons/logout-icon.png" alt="logout icon"></a>
            <?php endif;?>
            
            <a href="myCart.php"><img class="menu-icon" src="ressources/images/icons/cart-icon.png" alt="cart icon"></a>
        </div>
    </div>
