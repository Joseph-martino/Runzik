<?php

require_once("watchManager.php");
require_once("headphoneManager.php");
require_once("armbandManager.php");
require_once("productTypeManager.php");
require_once(ROOT_PATH ."models/products.php");

function getProducts($productType, $sortDesc = false) { //tri des marques

    $items = [];
    
    switch ($productType) {
        case "watch":
            $items = getWatches($sortDesc);
            break;
        case "headphone":
            $items = getHeadphones();
            break;
        case "armband":
            $items = getArmbands();
            break;
        default:
            $items = [];
            break;
    }

    $type = getProductTypeByName($productType);

    return new ProductList($type, $items);
}

function getProduct($productType, $id) {

    $items = [];
    
    switch ($productType) {
        case "watch":
            $items = [getWatch($id)];
            break;
        case "headphone":
            $items = [];
            break;
        case "armband":
            $items = [];
            break;
        default:
            $items = [];
            break;
    }

    $type = getProductTypeByName($productType);

    return new ProductList($type, $items);
}


?>