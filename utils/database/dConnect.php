<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
}

include_once(WEB_ROOTPATH . "utils/GLOBAL_DEFINES.php");

function DB_EstConnection(){

    global $dbEssential;

    try {
        
        $dbh_ = new PDO("mysql:host={$dbEssential["SQL_URL"]};
                         dbname={$dbEssential["DB_TARGET"]}", 
                         $dbEssential["DB_USER"], 
                         $dbEssential["DB_PSWD"]);

        // 設置PDO錯誤模式為異常
        $dbh_->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Failed to connect to database: " . $e->getMessage();
    }

    return $dbh_;
}