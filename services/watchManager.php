<?php
require_once(ROOT_PATH ."services/pdo.php");
require_once(ROOT_PATH ."models/watch.php");

function getWatches($sortDesc = false) { // ajouter tri des marques avant $sortdesc

    $sort = $sortDesc ? "DESC" : "";
    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT w.*, b.name brandName 
    FROM `watches` w 
    INNER JOIN `brands` b 
    on w.brandId = b.id
    ORDER BY w.price ". $sort ."
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

function getWatch($id) {

    $pdo = myPDO::getPDO();
    $statement = $pdo->prepare(
    "
    SELECT w.*, b.name brandName 
    FROM `watches` w 
    INNER JOIN `brands` b 
    on w.brandId = b.id
    WHERE w.id = ". $id ."
    ");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $watch =
        new Watch(
            $result["name"], 
            $result["price"], 
            $result["image"], 
            $result["quantity"], 
            $result["colour1"], 
            $result["colour2"], 
            $result["brandName"]
        );

    return $watch;
}



?>