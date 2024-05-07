<?php

include_once("PreDefines.php");

class Database{

    public function EstConnectionTo(string $DB_TARGET_, string $DB_USER, string $DB_PASSWORD, string $SQL_URL_ = "localhost:3306")
    {
        try {
        
            $dbObject_ = new PDO("mysql:host={$SQL_URL_}; dbname={$DB_TARGET_}", $DB_USER, $DB_PASSWORD);

            // 設置PDO錯誤模式為異常
            $dbObject_ -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo "Failed to connect to database: " . $e->getMessage();
        }

        return $dbObject_;
    }
};