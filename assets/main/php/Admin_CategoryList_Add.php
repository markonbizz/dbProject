<?php

if(($_SERVER["REQUEST_METHOD"] === "POST") && !(empty($_POST["categoryName"])) && ($_POST["categoryName"])){

    include_once("Database_EstConnection.php");

    $bNewCategory = $_POST["categoryName"] ?? "";

    $NEW_CATEGORY = 
    "
        INSERT INTO Categories
        (`Name`) VALUES (:Name)
    ";

    $ADD_CATEGORY_STMT = $dbHandler -> prepare($NEW_CATEGORY);
    $ADD_CATEGORY_STMT-> bindParam(":Name", $bNewCategory, PDO::PARAM_STR);

    try{

        if($ADD_CATEGORY_STMT -> execute()){
        
            return true;
        }else{
        
            return false;
        }
    }catch(PDOException $ERR){

        echo "Database error: " . $ERR->getMessage();

        return false;
    }
}