<?php
    DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
    require_once(ROOT_PATH ."services/pdo.php");
    require_once(ROOT_PATH ."services/pdoManager.php");
    require_once(ROOT_PATH ."services/productManager.php");
    require_once(ROOT_PATH ."services/cartManager.php");
    require_once(ROOT_PATH . "models/product.php");
    require_once(ROOT_PATH . "models/products.php");
    require_once(ROOT_PATH . "models/cart.php");
    require_once(ROOT_PATH . "models/cartProduct.php");
    
    session_start();
    if(!isset($_SESSION["user"])){
       header("Location: login.php");
       exit;
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/myCart.css" type="text/css"/>
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png"/>
    <title>Panier</title>
</head>
<body>
    <?php
        include( ROOT_PATH . "layout/header.php");
        include( ROOT_PATH ."layout/mobileHeader.php");
    ?>

    <div class="main-container">
        <section class="products-overview-container">
            <div class="products-overview-container-informations-container">
                <h2>Panier</h2> 
                <div class="table-products-container"> 
                    <table id="products">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Détail produit</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Sous total</th>
                                <th><form action="#" method="POST">
                                        <button  type="submit" name="delete-all-products">
                                            <img class="icon-size" src="ressources/images/icons/cart-delete-all-icon.png" alt="delete all products icon"></button>
                                    </form>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                    $cartId = $_SESSION["user"]["cart"]->getId();
                                    $cartProducts = CartManager::getCartProducts($cartId);
                                    
                                    if(isset($_POST["product-id"])) {
                                        $productId = $_POST["product-id"];
                                    }

                                    if(isset($_POST["delete-all-products"])){
                                        CartManager::deleteAllProductsFromCart($cartId);
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }

                                    if(isset($_POST["product-id"], $_POST["product-quantity"])){
                                        $productQuantity = $_POST["product-quantity"];
                                        if(!$productQuantity) {
                                            CartManager::deleteProductFromCart($cartId, $productId);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        } else {
                                            CartManager::updateProductQuantityFromCart($cartId, $productId, $productQuantity);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }
                                        
                                    }

                                    if(isset($_POST["product-id"], $_POST["delete"])){
                                        CartManager::deleteProductFromCart($cartId, $productId);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                    }

                                    foreach($cartProducts as $cartProduct) {

                                        echo "<tr>";
                                        echo "<td><img class=\"product-picture\" src=\"".$cartProduct->getProductImage()."\" alt=\"product-picture\"></td>";
                                        echo "<td>".$cartProduct->getProductName()."</td>";
                                        echo "<td>";
                                        echo "<form action=\"#\" method=\"POST\">";
                                        echo "<input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">";
                                        echo "<input type=\"number\" name=\"product-quantity\" min=\"0\" value=\"".$cartProduct->getQuantity()."\" onChange=\"submit()\"></td>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "<td>".$cartProduct->getProductPrice()."</td>";
                                        echo "<td>".$cartProduct->getProductSubtotal()."</td>";
                                        echo "<td>";
                                        echo "<form action=\"#\" method=\"POST\">";
                                        echo "<input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">";
                                        echo "<button type=\"submit\" name=\"delete\"><img src=\"ressources/images/icons/cart-bin-icon.png\" alt=\"delete icon\"</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }

                                    $allProductSubtotal = 0;
                                    foreach($cartProducts as $cartProduct) {
                                        $allProductSubtotal = $allProductSubtotal + $cartProduct->getProductSubtotal();
                                    }
                                ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="order-overview-card">
            <div class="order-overview-container">
                <div class="order-card-title">
                    <h2>Résumé de commande</h2>
                </div>
                
                <div class="order-overview-infos-container">
                    <h3 class="highlight-grey">Sous total:</h3>
                    <h3 class="highlight-grey"><?php echo $allProductSubtotal?>€</h3>
                </div>

                <div class="order-overview-infos-container">
                    <h3 class="highlight-grey">Frais de port:</h3>
                    <h3 class="highlight-grey">
                        <?php 
                            $shippingCost = CartManager::calculateShippingCost($allProductSubtotal);
                            echo $shippingCost;
                        ?> €
                    </h3>
                </div>

                <div class="horizontal-separator"></div>

                <div class="order-overview-infos-container">
                    <h3 class="highlight-black">Total:</h3>
                    <h3 class="highlight-black">
                        <?php 
                        echo $allProductSubtotal + $shippingCost;
                        ?> €
                    </h3>
                </div>

                <?php

                if(empty($cartProducts)){
                    echo "<a class=\"disabled-button\" href=\"#\">Ajouter des produits</a>";
                } else {
                    echo "<a class=\"order-validation-button\" href=\"cartAuth.php\">Valider ma commande</a>";
                }
                    
                ?>
            </div>
        </section>
    </div>

    <section class="mobile-order-overview-container">
            <?php
            
                foreach($cartProducts as $cartProduct) {
                    echo 
                    "<div class=\"mobile-cart-product-infos-container\">

                        <img class=\"product-picture\" src=\"".$cartProduct->getProductImage()."\" alt=\"product-picture\">
                        <div class=\"product-general-infos\">
                            <p>".$cartProduct->getProductName()."</p>

                            <div class=\"mobile-product-quantity-container\">
                                <p>".$cartProduct->getProductPrice()."€</p>

                                <form class=\"quantities-form\" action=\"#\" method=\"POST\">
                                <button onclick=\"this.parentNode.querySelector('input[type=number]').stepDown()\">-</button>
                                    <input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">
                                    <input type=\"number\" name=\"product-quantity\" min=\"0\" value=\"".$cartProduct->getQuantity()."\" onChange=\"submit()\">
                                    <button onclick=\"this.parentNode.querySelector('input[type=number]').stepUp()\">+</button>
                                </form>

                                <form action=\"#\" method=\"POST\">
                                    <input type=\"hidden\" name=\"product-id\" value=\"".$cartProduct->getProductId()."\">
                                    <button class=\"delete-button\" type=\"submit\" name=\"delete\"><img src=\"ressources/images/icons/cart-bin-icon.png\" alt=\"delete icon\"</button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }
            
            
            ?>


            <div class="mobile-card-container">
                <div class="order-card-title">
                    <h2>Résumé de commande</h2>
                </div>

                <div class="mobile-order-overview-card">
                    <div class="mobile-order-overview-labels-container">
                        <h4 class="highlight-grey">SOUS TOTAL:</h4>
                        <h4 class="highlight-grey">FRAIS DE PORT:</h4>
                        <h3 class="highlight-black">TOTAL:</h3>
                    </div>

                    <div class="mobile-order-overview-labels-container">
                        <h3 class="highlight-grey"><?php echo $allProductSubtotal?>€</h3>
                        
                        <h3 class="highlight-grey">
                            <?php 
                                $shippingCost = CartManager::calculateShippingCost($allProductSubtotal);
                                echo $shippingCost;
                            ?> €
                        </h3>

                        <h3 class="highlight-black">
                            <?php 
                                echo $allProductSubtotal + $shippingCost;
                            ?> €
                        </h3>
                    </div>
                </div>
            </div>  
            <?php
                    if(empty($cartProducts)){
                        echo "<a class=\"disabled-button\" href=\"#\">Ajouter des produits</a>";
                    } else {
                        echo "<a class=\"order-validation-button\" href=\"cartAuth.php\">Valider ma commande</a>";
                    }     
                ?>
     </section>
</body>
</html>
