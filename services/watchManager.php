<?php
require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/watch.php");

function getWatches() {

    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT w.*, b.name brandName 
    FROM `watches` w 
    INNER JOIN `brands` b 
    on w.brandId = b.id
    ");
    $statement->execute();
    $watches = $statement->fetchAll(PDO::FETCH_ASSOC);
    $allWatches = [];
    foreach($watches as $watch){
        $allWatches[]= 
        new Watch(
        $watch["name"], 
        $watch["price"], 
        $watch["image"], 
        $watch["quantity"], 
        $watch["colour1"], 
        $watch["colour2"], 
        $watch["brandName"]
    );
    }

    return $allWatches;
}



?>