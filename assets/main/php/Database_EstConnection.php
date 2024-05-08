<?php

$SQL_URL        = "localhost:3306";
$DB_TARGET      = "DEArmory";
$PMA_USER       = "root";
$PMA_PASSWORD   = "#u2324";

try{
        
    $dbHandler = new PDO("mysql:host={$SQL_URL}; dbname={$DB_TARGET}", $PMA_USER, $PMA_PASSWORD);

    // Set PDO ERR Mode as Expection
    $dbHandler -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $err){

    echo "Failed to connect to database: " . $err->getMessage();
}