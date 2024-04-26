<?php

$sql_url    = "localhost:3306";
$dbUser     = "root";
$dbPasswd   = "#u2324";
$tgtDB      = "DEArmory";

function EstConnection(){

    global $sql_url,
           $dbUser,
           $dbPasswd,
           $tgtDB;

    try {
        
        $dbh_ = new PDO("mysql:host=$sql_url;dbname=$tgtDB", $dbUser, $dbPasswd);
        // 設置PDO錯誤模式為異常
        $dbh_->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Failed to connect to database: " . $e->getMessage();
    }

    return $dbh_;
}