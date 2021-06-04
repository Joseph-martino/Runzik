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
    <title>Panier</title>
</head>
<body>
    <?php
        include( ROOT_PATH . "layout/header.php");
    ?>

    <div class="main-container">
        <section class="products-overview-container">
            <div class="products-overview-container-informations-container">
                <h2>Panier</h2>  
                <table id="products">
                    <thead>
                        <tr>
                            <th>Détail produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Sous total</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                                $cartId = $_SESSION["user"]["cart"]->getId();
                                $cartProducts = CartManager::getCartProducts($cartId);
                                
                                if(isset($_POST["product-id"])) {
                                    $productId = $_POST["product-id"];
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
        </section>

        <section class="order-overview-card">
            <div class="order-overview-container">
                <div class="order-card-title">
                    <h2>Résumé de commande</h2>
                </div>
                
                <div class="order-overview-infos-container">
                    <h3>Sous total:</h3>
                    <h3><?php echo $allProductSubtotal?>€</h3>
                </div>

                <div class="order-overview-infos-container">
                    <h3>Frais de port:</h3>
                    <h3>
                        <?php 
                            $shippingCost = CartManager::calculateShippingCost($allProductSubtotal);
                            echo $shippingCost;
                        ?> €
                    </h3>
                </div>

                <div class="horizontal-separator"></div>

                <div class="order-overview-infos-container">
                    <h3>Total:</h3>
                    <h3>
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
</body>
</html>
