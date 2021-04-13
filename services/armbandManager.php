<?php
require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/armband.php");

function getArmbands() {

    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT a.*, b.name brandName 
    FROM `armbands` a 
    INNER JOIN `brands` b 
    on a.brandId = b.id
    ");
    $statement->execute();
    $armbands = $statement->fetchAll(PDO::FETCH_ASSOC);
    $allArmbands = [];
    foreach($armbands as $armband){
        $allArmbands[]= 
        new Armband(
        $armband["name"], 
        $armband["price"], 
        $armband["image"], 
        $armband["quantity"], 
        $armband["colour1"], 
        $armband["colour2"], 
        $armband["brandName"]
    );
    }

    return $allArmbands;
}





?>