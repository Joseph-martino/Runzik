<?php
require_once("models/pdo.php");
require_once("models/product.php");
require_once("models/products.php");
require_once("models/watch.php");
?>

<h1>Produits</h1>

<?php

$pdo = myPDO::getPDO();
$statement = $pdo->prepare("SELECT * FROM `watches` w INNER JOIN `brands` b on w.brandId = b.id");
$statement->execute();
$watches = $statement->fetchAll();
$allwatches = [];
foreach($watches as $watch){
    $allwatches[]= new Watch($watch["name"], $watch["price"], $watch["image"], $watch["quantity"], $watch["colour1"], $watch["colour2"], $watch["brandId"]);
    // echo $watch["name"]. "<br/>";
    // echo $watch["price"]. "<br/>";
    // echo $watch["image"]. "<br/>";
    // echo $watch["quantity"]. "<br/>";
    // echo $watch["colour1"]. "<br/>";
    // echo $watch["colour2"]. "<br/>";
    // echo $watch["brandId"]. "<br/>";
}

echo "<pre>";
print_r($allwatches);



?>