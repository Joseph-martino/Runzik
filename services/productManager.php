<?php

require_once("watchManager.php");
require_once("headphoneManager.php");
require_once("armbandManager.php");
require_once("productTypeManager.php");
require_once(ROOT_PATH ."models/products.php");

function getProducts($productType) {

    $items = [];
    
    switch ($productType) {
        case "watch":
            $items = getWatches();
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


?>