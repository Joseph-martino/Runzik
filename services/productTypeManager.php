<?php

require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/productType.php");

function getProductTypes() {

    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT * 
    FROM `productTypes`
    ");
    $statement->execute();
    $productTypes = $statement->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre style=\"color: white;\">";
    // print_r( $productTypes);
    // echo "</pre>";
    $allProductTypes = [];
    foreach($productTypes as $productType){
        $allProductTypes[]= 
        new ProductType(
        $productType["name"], 
        $productType["displayName"], 
        $productType["displayNamePlural"]
    );
    }

    return $allProductTypes;
}

function getProductTypeByName($name) {

    if($name === NULL) {
        return new ProductType(NULL, NULL, NULL);
    }

    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT * 
    FROM `producttypes`
    Where name = '".$name."'
    ");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $productType = new ProductType(
        $result["name"], 
        $result["displayName"], 
        $result["displayNamePlural"]
    );

    return $productType;
}


?>