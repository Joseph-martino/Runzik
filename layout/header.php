<?php 
    require_once(ROOT_PATH ."services/productTypeManager.php");

    $types = ProductTypeManager::getProductTypes();
?>


<div class="mobile-header">
    <img class="runzik-logo" src="ressources/images/logos/logo-runzik.png" alt="Runzik Logo">
    <a class="cart-link" href="cart.php"><img class="cart-icon" src="ressources/images/icons/cart-icon.png"
            alt="cart icon"></a>
</div>


<div class="mobile-menu">

    <div class="menu-top-line"></div>
    <div class="bottom-menu">
        <a class="brand-link" href="brand.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/brand-icon.png" alt="brand icon"></a>
        <a class="wishlist-link" href="account.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/wishlist-icon.png" alt="wishlist icon"></a>
        <a class="buy-link" href="shop.php?product=watch"><img class="mobile-menu-icon" src="ressources/images/icons/buy-icon.png"
                alt="buy icon"></a>
        <a class="contact-link" href="contact.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/contact-icon.png" alt="contact-icon"></a>
        <a class="account-link" href="account.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/my-account-icon.png" alt="account icon"></a>
    </div>
</div>

    <div class="desktop-menu">
        <div class="logo-container">
            <a href="index.php"><img src="ressources/images/logos/logo-runzik.png" alt="Runzik Logo"></a>
        </div>

        <div class="tabs-menu">
            <nav class="navbar">
                <ul>
                    <li><a href="runzik.php">La marque</a></li>
                    <li><a href="#">La boutique</a>
                        <ul class="submenu">
                        <?php 
                            
                            for($i = 0; $i < count($types); $i++) {
                                $type = $types[$i];
                                echo "
                                <li><a href=\"shop.php?product=".$type->type."\">".$type->pluralName."</a></li>
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
                <p>Bonjour <?php echo $_SESSION["user"]["pseudo"]?></p>
                <a href="profile.php"><img class="menu-icon" src="ressources/images/icons/logged-in-profile-icon.png" alt="logout icon"></a>
                <a href="logout.php"><img class="menu-icon" src="ressources/images/icons/logout-icon.png" alt="logout icon"></a>
            <?php endif;?>
            
            <a href="myCart.php"><img class="menu-icon" src="ressources/images/icons/cart-icon.png" alt="cart icon"></a>
        </div>
    </div>
