<?php
    const HOST_NAME = "localhost";
    const DB_NAME = "runzik";
    const USER_NAME = "root";
    const PASSWORD = "";

    try {
        $connexion = "mysql:host=".HOST_NAME."; dbname = ".DB_NAME;
        $myPDO = new PDO($connexion, USER_NAME, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch(PDOException $exception){
        $errorMessage = "Erreur de connexion à la base de données".$exception->getMessage();
        die($errorMessage);
    }
?>