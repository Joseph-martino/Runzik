<?php

require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/brand.php");

        
function getBrands() {
    $pdo = myPDO::getPDO();
    $statement= $pdo->prepare("SELECT * FROM `brands`");
    $statement->execute();
    $brands = $statement->fetchAll(PDO::FETCH_ASSOC);
    $allBrands = [];
    foreach($brands as $brand){
        $allBrands[] = new Brand($brand["name"]);
    }
    return $allBrands;
}

?>