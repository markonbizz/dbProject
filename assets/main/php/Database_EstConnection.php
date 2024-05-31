<?php

$SQL_URL        = "localhost";
$DB_TARGET      = "ciai_dbst";
$PMA_USER       = "cbb111237";
$PMA_PASSWORD   = "000000";

try{
        
    $dbHandler = new PDO("mysql:host={$SQL_URL}; dbname={$DB_TARGET}", $PMA_USER, $PMA_PASSWORD);

    // Set PDO ERR Mode as Expection
    $dbHandler -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){

    echo "Failed to connect to database: " . $e->getMessage();
}