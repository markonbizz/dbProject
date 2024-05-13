<?php

include_once("Database_EstConnection.php");

$SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM `Categories`");

try{

    if($SQL_STATMENT -> execute())
    {
        while($DATA = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC))
        {
            echo 
            "
                <option value=\"{$DATA["CategoryID"]}\">{$DATA["Name"]}</option>
            ";
        }
    }

}catch(PDOException $ERR){

    echo "Database Error:" . $ERR->getMessage();
}