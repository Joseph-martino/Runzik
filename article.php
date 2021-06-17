<?php 
DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."services/pdoManager.php");
require_once(ROOT_PATH ."services/authentificationManager.php");
require_once(ROOT_PATH ."services/productManager.php");
require_once(ROOT_PATH ."services/cartManager.php");
require_once(ROOT_PATH . "models/products.php");
require_once(ROOT_PATH . "models/cart.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/article.css" type="text/css"/>
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title><?php echo "test"; ?></title>
</head>
    <body>
        <?php
           $selectedProduct = "";
           if (isset($_GET["product"])) {                
               $selectedProduct = $_GET["product"];
           }

           $selectedProductId = "";
           if (isset($_GET["id"])) {                
            $selectedProductId = $_GET["id"];
        }
           $currentProduct = ProductManager::getProduct($selectedProduct, $selectedProductId);
           if(isset($_SESSION["user"])){
            $cartId = $_SESSION["user"]["cart"]->getId();
           }
        ?>

        <?php
            include(ROOT_PATH ."layout/mobileHeader.php");
        ?>

        <div class="mobile-banner-container">
            <form action="#" method="POST">
            <?php
                $mobileColour1 = $currentProduct->items->getColour1();
                $mobileColour2 = $currentProduct->items->getColour2();
             ?>

                <div class="switch-container">
                    <label class="switch">
                        <input id="mobile-colour-checkbox" type="checkbox" name="mobile-product-colour" value="">
                        <span class="slider round"></span>
                    </label>
                </div>
                <p id="mobile-colour-text"><?php echo $mobileColour1;?></p>
            </form>

            <img class="mobile-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-mobile-banner-background" alt="mobile-banner">
            <img id = "mobile-banner-product" class="mobile-<?php echo $currentProduct->infos->type ?>-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type."-mobile-banner".$currentProduct->items->getId() ?>" alt="<?php echo $currentProduct->infos->type ?>-banner">
            <div class="mobile-banner-title">
                <p class="product-name"><?php echo $currentProduct->items->getName() ?></p>
                <p class="product-description">Profitez pleinement de vos sorties sportives</p>
                <p class="product-price"><?php echo $currentProduct->items->getPrice() ?>€</p>
            </div>   
            <div class="mobile-header-container">
            </div>
        </div>

        <script>
                const productType = "<?php echo $selectedProduct ?>";
                const mobileProductId = "<?php echo $selectedProductId ?>";
                let mobileProductBannerPicture = document.getElementById("mobile-banner-product");
                let mobileColourtext = document.getElementById("mobile-colour-text");

                const colourCheckbox = document.querySelector("input[name=mobile-product-colour]");
                colourCheckbox.addEventListener("change", function() {
                    if(!this.checked) {
                        mobileColourtext.innerHTML = "<?php echo $mobileColour1; ?>";
                        mobileProductBannerPicture.src = "ressources/images/banners/" + productType + "-mobile-banner" + mobileProductId + ".png";
                    } else {
                        mobileColourtext.innerHTML = "<?php echo $mobileColour2; ?>";
                        mobileProductBannerPicture.src = "ressources/images/banners/" + productType + "-mobile-banner" + mobileProductId + "-colour2.png";
                    }
                });
            </script>
        
        <div class="banner-container">
            <img class="desktop-page-banner" src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-banner-background" alt="product banner">
            <img id ="banner-product" class="banner-product" src="ressources/images/banners/<?php echo $currentProduct->infos->type."-banner".$currentProduct->items->getId() ?>" alt="banner-<?php echo $currentProduct->infos->type ?>">
            <div class=banner-title>
                <h1><?php echo $currentProduct->items->getName() ?></h1>
                <p class="product-description">Profitez pleinement de vos sorties sportives</p>
                <p class="price"><?php echo $currentProduct->items->getPrice() ?>€</p>
            </div>
            <div class="header-container">
                <?php
                    include(ROOT_PATH ."layout/header.php");
                ?>
            </div>
            
            
            <div class="colours-choices-container">
                <p>Coloris</p>
                <form action="#" method="POST">
                <?php
                
                    for($i = 0; $i < 2; $i++){
                        $radioId;
                        $radioValue;
                        switch($i) {
                            case 0:
                                $radioId = $i;
                                $radioValue = $currentProduct->items->getColour1();
                                break;
                            case 1:
                                $radioId = $i;
                                $radioValue = $currentProduct->items->getColour2();
                                break;                 
                        }
                        echo "<input type=\"radio\" id=\"".$radioId."\" name=\"product-colour\" value=\"".$radioValue."\">
                        <label for=\"".$radioId."\"></label>";
                    }
                    
                ?>
                        <input class="quantity-input-container" type="number" id="quantity" name="product-quantity" min="1" value="1">
                        <label for="quantity"></label>
                        <input type="hidden" name="add-to-cart" value="true">
                        <p id="product-colour-text"></p> 
                    <div class="add-to-cart-button-container">
                        <input id="button-test" class="blue-button" type="submit" value="Ajouter au panier">
                    </div>

                    <?php
                        if(isset($_POST["add-to-cart"]) && !empty($_POST["add-to-cart"])) {
                            if(isset($_SESSION["user"])) {
                                CartManager::addProductToCart($cartId, $selectedProductId, $_POST["product-quantity"]);
                                echo "<meta http-equiv='refresh' content='0'>";
                                // $totalQuantity = CartManager::getTotalProductsQuantity($cartId);
                                // echo "<p><style> p { color: red }</style>".$totalQuantity."</p>";
                                // $_SESSION["user"]["quantity"] = $totalQuantity;
                                //  $test = CartManager::getProductTest($selectedProductId);
                                //  var_dump($test);
                                //  $cartTest->addProduct($test);
                                //  $cartAllproducts = $cartTest->getAllProducts();
                                //  var_dump($cartAllproducts);
                                // $product = $_SESSION["user"]["cart"]->addProduct(new Product($selectedProductId, ));


                                // mettre le cartId en paramètre
                                // CartManager::addProductToCart($selectedProductId, $_POST["product-quantity"]);
                            } else {
                                echo "<p>Connectez-vous</p>";
                            }  
                        }
                    ?>   
                </form>
            </div>           
        </div>

        <script>
            const productTest = "<?php echo $selectedProduct ?>";
            const productId = "<?php echo $selectedProductId ?>";
            let bannerPicture = document.getElementById("banner-product");
            let productColourText = document.getElementById("product-colour-text");

            const colors = document.querySelectorAll('input[name="product-colour"]'); 
                if (colors.length) {
                    colors.forEach(function (elem) {
                    elem.addEventListener("change", function(event) {
                        productColourText.innerHTML = elem.value;
                        if(elem.id === "0" || event.target.value === undefined) {
        
                            bannerPicture.src = "ressources/images/banners/" + productTest + "-banner" + productId + ".png";
                            
                        } else if (elem.id === "1") {
                            bannerPicture.src = "ressources/images/banners/" + productTest + "-banner" + productId + "-colour2.png";
                        
                        }
                    });
                    });
                }
        </script> 

        <section class="product-informations-container">
            <img class="product-information-picture" src="ressources/images/photos/<?php echo $currentProduct->infos->type ?>-product-side-picture" alt="sitting man picture">
            <div class="informations-container">
                <div class="section-title">
                    <h2>INFORMATIONS PRODUIT</h2>
                </div>

                <div class="mobile-information-text-container">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat morbi faucibus mattis sollicitudin malesuada sed et in. 
                    In sed amet, nibh cursus ac tellus porttitor at. Quam ac tortor pretium nibh sagittis sit id pretium.
                    </p>

                </div>

                <div class="product-informations-text-container">

                <?php
                for($i = 0; $i<4; $i++){
                    echo "<div class=\"product-informations-content\">
                            <div class=\"product-informations-content-subtitle\">
                                <img class=\"checkmark\" src=\"ressources/images/icons/checkmark.png\" alt=\"checkmark icon\">
                                <h3>Titre</h3>
                            </div>
                            <p class=\"white-text\">Lorem ipsum dolor sit amet, <span class=\"orange-highlight\">consectetur</span> adipiscing elit. <span class=\"orange-highlight\">Lorem ipsum dolor sit amet</span> , consectetur adipiscing elit.</p>
                        </div>";
                }
                ?>
                </div>
            </div>
        </section>

        

        <section class="feature-section">
            <div class="section-title">
                <h2>DETAILS TECHNIQUES</h2>
            </div>
            <div class="product-features-container">
                <?php
                for($i = 0; $i < 6; $i++){
                    $featureName;
                    $numberBox;
                                switch ($i) {
                                    case 0:
                                        $featureName ="phone";
                                        break;
                                    case 1: 
                                        $featureName ="music";
                                        break;
                                    case 2:
                                        $featureName ="bluetooth";
                                        break;
                                    case 3:
                                        $featureName ="heart-with-pulse";
                                        break;
                                    case 4: 
                                        $featureName ="meteo";
                                        break;
                                    case 5:
                                        $featureName ="location";
                                    break;
                                }

                                if($i %2  === 0){
                                    $numberBox = "even-numbers-box";

                                } else {
                                    $numberBox = "odd-numbers-box";
                                    
                                }
                                     
                            echo "<div class=\"feature-container ".$numberBox."\">
                                    <img class=\"feature-icon\" src=\"ressources/images/icons/".$featureName."-icon.png\" alt=\"".$featureName." icon\">
                                    <h3>Lorem ipsum</h3>
                                    <p class=\"white-text\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis sit donec parturient neque at tempus. 
                                    Eget felis lorem cursus dignissim id at facilisis enim.</p>
                                </div>";
                }
                ?>
            </div>

            <div class="mobile-product-features-container">
                <?php
                $cardClassSwitch = true;
                for($i = 0; $i < 6; $i++){
                    $featureName;
                    $numberBox = "odd-numbers-box";
                                switch ($i) {
                                    case 0:
                                        $featureName ="phone";
                                        break;
                                    case 1: 
                                        $featureName ="music";
                                        break;
                                    case 2:
                                        $featureName ="bluetooth";
                                        break;
                                    case 3:
                                        $featureName ="heart-with-pulse";
                                        break;
                                    case 4: 
                                        $featureName ="meteo";
                                        break;
                                    case 5:
                                        $featureName ="location";
                                    break;
                                }
                                
                                if($cardClassSwitch) {
                                    $numberBox = "even-numbers-box";
                                }

                                $cardClassSwitch = !$cardClassSwitch;
                                
                            echo "<div class=\"feature-container ".$numberBox."\">
                                    <img class=\"feature-icon\" src=\"ressources/images/icons/".$featureName."-icon.png\" alt=\"".$featureName." icon\">
                                    <h3>Lorem ipsum</h3>
                                    <p class=\"white-text\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gravida venenatis sit donec parturient neque at tempus. 
                                    Eget felis lorem cursus dignissim id at facilisis enim.</p>
                                </div>";
                }
                ?>
            </div>
        </section>

        <img class="second-banner"src="ressources/images/banners/<?php echo $currentProduct->infos->type ?>-article-picture.png" alt="<?php echo $currentProduct->infos->type ?>">

        
        <section class="technology-container">
            <div class="section-title">
                <h2>NOTRE TECHNOLOGIE</h2>
            </div>
            <div class="technology-explanations-container">
                <div class="technology-text">
                <h3>TECHNOLOGIE : L'OSTÉOPHONIE OU CONDUCTION OSSEUSE</h3>
                <p>
                Ce casque ouvert vous permet de téléphoner ou d’écouter votre MP3 et les bruits autour de vous. 
                Le casque Run’Zik dispose de 2 transducteurs qui émettent des mini vibrations qui passent par les 
                os des pommettes et des joues pour arriver directement à la cochlée (l’oreille interne). 
                Vous avez les oreilles libres ; rien ne les bouche ou ne les recouvre
                </p>
                </div>
               <div class="desktop-pictures-container">
                    <div class="technology-pictures-container">
                        <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                        <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                        <img src="ressources/images/photos/watching-<?php echo $currentProduct->infos->type ?>-man.png" alt="watching-<?php echo $currentProduct->infos->type ?>-man">
                    </div>
               </div>
            </div>
            <img class="product-picture"src="ressources/images/products/<?php echo $currentProduct->infos->pluralName ?>.png" alt="<?php echo $currentProduct->infos->pluralName ?>">
        </section>
        <?php
            include(ROOT_PATH ."layout/footer.php");
        ?>

        <div class="mobile-add-to-cart-menu">
            <form action="#" method = "POST">
                <div class="mobile-quantity-input-container">
                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                    <input class="mobile-quantity-input" type="number" id="quantity" name="mobile-product-quantity" min="1" value="1">
                    <label for="quantity"></label> 
                    <input type="hidden" name="mobile-add-to-cart" value="true">
                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                    <button class="mobile-add-to-cart" type="submit">Ajouter au panier</button>
                </div>
                <!-- <div class="mobile-add-to-cart-button-container">
                    <button class="mobile-add-to-cart" type="submit">Ajouter au panier</button>
                </div> -->
            </form>
        </div>

        <?php
            if(isset($_POST["mobile-add-to-cart"]) && !empty($_POST["mobile-add-to-cart"])) {
                if(isset($_SESSION["user"])) {
                    CartManager::addProductToCart($cartId, $selectedProductId, $_POST["mobile-product-quantity"]);
                    } else {
                echo "Connectez-vous";
            }  
        }
        ?> 

        <script type="text/javascript" src="ressources/scripts/article.js"></script>
    </body>
</html>