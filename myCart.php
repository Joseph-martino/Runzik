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
    var_dump($_SESSION["user"]);
    // $allProductsInCart = $_SESSION["user"]["cart"]->getAllProducts();
    // var_dump($allProductsInCart);

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
                <table>
                    <thead>
                        <tr>
                            <th>Détail produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th></th>
                        </tr>

                        <tbody>
                                <?php
                                    $cartId = $_SESSION["user"]["cart"]->getId();
                                    $cartProducts = CartManager::getCartProducts($cartId);
                                   
                                    foreach($cartProducts as $cartProduct) {
                                        echo "<tr>";
                                        echo "<td>".$cartProduct->getProductName()."</td>";
                                        echo "<td>".$cartProduct->getQuantity()."</td>";
                                        echo "<td>".$cartProduct->getProductPrice()."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </tbody>
                    </thead>
                </table>
            </div>

        </section>

        <section>

        </section>
    </div>
    
</body>
</html>
