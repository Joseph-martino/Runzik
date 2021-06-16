<?php 
require_once(ROOT_PATH ."services/productTypeManager.php");
$types = ProductTypeManager::getProductTypes();
$url = $_SERVER['PHP_SELF'];
$selectedProduct = "";
if (isset($_GET["product"])) {                
  $selectedProduct = $_GET["product"];
}
?>

<div class="mobile-header">
        <a  class="mobile-logo-container" href="index.php"><img class="runzik-logo" src="ressources/images/logos/logo-runzik.png" 
        alt="Runzik Logo"></a>
        
        <div class="mobile-cart-icon-container">
                <a class="cart-link" href="myCart.php"><img class="cart-icon" src="ressources/images/icons/cart-icon.png"
                alt="cart icon"></a>
                <?php 
                        if(isset($_SESSION["user"])) {
                        echo "<span class=\"mobile-total-quantity-bubble\">".$_SESSION["user"]["quantity"]."<span>";
                }
                ?>
        </div>
        

        <?php if(!isset($_SESSION["user"])): ?>
                <a class="cart-link" href="login.php"><img class="login-icon" src="ressources/images/icons/login-icon.png"
                alt="login icon"></a>

        <?php else: ?>
                <a class="profile-link" href="profile.php"><img class="profile-icon" src="ressources/images/icons/logged-in-profile-icon.png" alt="logout icon"></a>
                <a class="logout-link" href="logout.php"><img class="logout-icon" src="ressources/images/icons/logout-icon.png" alt="logout icon"></a>
        <?php endif;?>
</div>

<div class="mobile-menu">
        <div class="menu-top-line"></div>
        <!-- <div class="bottom-menu">
        <a class="home-link" href="index.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/mobile-menu-home-icon.png" alt="home icon"></a>

        <a class="brand-link" href="runzik.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/brand-icon.png" alt="brand icon"></a>

        <a class="watch-link" href="shop.php?product=watch"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-watch-menu-icon .png"
                alt="watch icon"></a>

        <a class="headphone-link" href="shop.php?product=headphone"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-headphone-menu-icon.png"
                alt="watch icon"></a>

        <a class="armband-link" href="shop.php?product=armband"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-armband-menu-icon.png"
                alt="watch icon"></a>

        <a class="contact-link" href="contact.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/contact-icon.png" alt="contact-icon"></a>
        </div> -->
        

        <div class="bottom-menu">
        <?php if($url === "/Runzik/index.php"): ?>
                <a class="home-link" href="index.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/mobile-menu-home-icon-selected.png" alt="home icon"></a>
        <?php else: ?>
                <a class="home-link" href="index.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/mobile-menu-home-icon.png" alt="home icon"></a>
        <?php endif;?>

        <?php if($url === "/Runzik/runzik.php"): ?>
                <a class="brand-link" href="runzik.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/brand-icon-selected.png" alt="brand icon"></a>
        <?php else: ?>
                <a class="brand-link" href="runzik.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/brand-icon.png" alt="brand icon"></a>
        <?php endif;?>

        <?php if($url === "/Runzik/shop.php" && $selectedProduct === "watch"): ?>
                <a class="watch-link" href="shop.php?product=watch"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-watch-menu-icon-selected.png"
                alt="watch icon"></a>
        <?php else: ?>
                <a class="watch-link" href="shop.php?product=watch"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-watch-menu-icon.png"
                alt="watch icon"></a>
        <?php endif;?>

        <?php if($url === "/Runzik/shop.php" && $selectedProduct === "headphone"): ?>
                <a class="headphone-link" href="shop.php?product=headphone"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-headphone-menu-icon-selected.png"
                alt="watch icon"></a>
        <?php else: ?>
                <a class="headphone-link" href="shop.php?product=headphone"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-headphone-menu-icon.png"
                alt="watch icon"></a>
        <?php endif;?>

        <?php if($url === "/Runzik/shop.php" && $selectedProduct === "armband"): ?>
                <a class="armband-link" href="shop.php?product=armband"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-armband-menu-icon-selected.png"
                alt="watch icon"></a>
        <?php else: ?>
                <a class="armband-link" href="shop.php?product=armband"><img class="mobile-menu-icon" src="ressources/images/icons/mobile-armband-menu-icon.png"
                alt="watch icon"></a>
        <?php endif;?>

        <?php if($url === "/Runzik/contact.php"): ?>
                <a class="contact-link" href="contact.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/contact-icon-selected.png" alt="contact-icon"></a>
        <?php else: ?>
                <a class="contact-link" href="contact.php"><img class="mobile-menu-icon"
                src="ressources/images/icons/contact-icon.png" alt="contact-icon"></a>
        <?php endif;?>
        </div>






</div>