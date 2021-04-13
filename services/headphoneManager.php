<?php
require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/headphone.php");

function getHeadphones() {
    
    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare("SELECT h.*, b.name brandName FROM `headphones` h INNER JOIN `brands` b on h.brandId = b.id");
    $statement->execute();
    $headphones = $statement->fetchAll(PDO::FETCH_ASSOC);
    $allHeadphones = [];
    foreach($headphones as $headphone){
        $allHeadphones[]= 
        new Headphone(
        $headphone["name"], 
        $headphone["price"], 
        $headphone["image"], 
        $headphone["quantity"], 
        $headphone["colour1"], 
        $headphone["colour2"], 
        $headphone["brandName"]
        );
    }
    return $allHeadphones;
}


?>