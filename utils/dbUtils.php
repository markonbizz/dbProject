<?php

class Database{

    private $sql_url = null;
    private $dbUsername = null;
    private $dbPassword = null;

    public function __construct($sql_url, $dbUsername, $dbPassword){
        
        $this->sql_url  = $sql_url;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
    }

    public function EstablishConnection($targetDB){
        
        try{

            $_db = new PDO("mysql:host={$this->sql_url}; dbname={$targetDB};", $this->dbUsername, $this->dbPassword);
            $_db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Set PDO Error Mode as Expection
        }catch (PDOException $e){

            echo "Failed to establish the database <br>".
                "Error: ". $e->getMessage();
        }

        return $_db;
    }
};