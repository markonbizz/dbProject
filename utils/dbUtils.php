<?php

$db_keyset = array(
                    "host"  => "localhost:3306",
                    "user"  => "root",
                    "passwd"=> "#u2324",
                    "tgt"   => "armory"
                  );

class Database{

    public function EstablishConnection(){
        
        global $db_keyset;
        
        try{

            $db_ = new PDO("mysql:host={$db_keyset["host"]}; dbname={$db_keyset["tgt"]};", $db_keyset["user"], $db_keyset["passwd"]);
            $db_ -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Set PDO Error Mode as Expection
        }catch (PDOException $e){

            echo "Failed to establish the database <br>".
                "Error: ". $e->getMessage();
        }

        return $db_;

    }
};