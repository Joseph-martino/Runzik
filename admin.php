<?php
DEFINE("ROOT_PATH", dirname(__FILE__) . "/");
require_once(ROOT_PATH . "services/pdo.php");
require_once(ROOT_PATH . "services/pdoManager.php");
require_once(ROOT_PATH . "services/authentificationManager.php");
require_once(ROOT_PATH . "services/AdminManager.php");

session_start();
if (!isset($_SESSION["user"]["isAdmin"])) {
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
    <link rel="stylesheet" href="ressources/css/admin.css" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/images/logos/runzik-black-logo.png" />
    <title>Tableau de bord</title>
</head>

<body>

    <?php
    $users = AdminManager::getAllUsers();
    $products = AdminManager::getAllProductsFromDatabase();
    include(ROOT_PATH . "layout/mobileHeader.php");
    ?>

    <div class="banner-container">
        <img src="ressources/images/banners/admin-dasboard-banner.png" alt="people who are running">
        <h1 class="banner-title">Tableau de <span class="orange-highlight">bord</span></h1>
        <div class="header-container">
            <?php
            include(ROOT_PATH . "layout/header.php");
            ?>
        </div>
    </div>

    <section class="users-management-section">
        <div class="title-container">
            <img class="title-icon" src="ressources/images//icons/my-account-icon.png" alt="user management icon">
            <h2 class="section-title">Gestion des utilisateurs</h2>
        </div>
    </section>

    <div class="table-container">
        <table id="users">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<input type=\"hidden\" name=\"user-id\" value=\"" . $user->getId() . "\">";
                    echo "<p>" . $user->getUsername() . "</p>";
                    echo "</td>";

                    echo "<td>";
                    echo "<p>" . $user->getEmail() . "</p>";
                    echo "</td>";

                    echo "<td>";
                    $role = $user->getRole();
                    $checked = $role == 1 ? "checked" : "";
                    echo "<input class=\"checkbox\" type=\"checkbox\" id=\"role-checkbox\" name=\"user-role\" " . $checked . " disabled>";
                    echo "</td>";

                    echo "<td>";
                    echo "<div class=\"update-table-icon-container\">";
                    echo "<a class=\"update-link-button\" href=\"editUser.php?userid=" . $user->getId() . "\"><img class=\"update-icon\" src=\"ressources/images//icons/update-icon.png\" alt=\"update-icon\"></a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <section class="users-management-section">
        <div class="title-container">
            <img src="ressources/images/icons//product-icon.png" alt="product icon">
            <h2 class="section-title">Gestion des produits</h2>

        </div>


        <div class="table-container">
            <table id="products">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Nom du produit</th>
                        <th>Prix du produit</th>
                        <th>Marque du produit</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=\"hidden\" name=\"product-id\" value=\"" . $product->getId() . "\">";
                        echo "<img class=\"product-picture\" src=\"" . $product->getImage() . "\" alt=\"product-picture\">";
                        echo "</td>";

                        echo "<td>";
                        echo "<p>" . $product->getName() . "</p>";
                        echo "</td>";

                        echo "<td>";
                        echo "<p>" . $product->getPrice() . "</p>";
                        echo "</td>";

                        echo "<td>";
                        echo "<p>" . $product->getBrand() . "</p>";
                        echo "</td>";

                        echo "<td>";
                        echo "<a class=\"desktop-product-update-link-button\" href=\"editProduct.php?productid=" . $product->getId() . "\">Modifier</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>