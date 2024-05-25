<?php

if(($_SERVER["REQUEST_METHOD"] === "POST") && !(empty($_POST["categoryID"])) && ($_POST["categoryID"])){

    include_once("Database_EstConnection.php");

    $bTargetCategory = $_POST["categoryID"] ?? "";

    $REMOVE_CATEGORY = 
    "
        DELETE FROM Categories
        WHERE
        `CategoryID` = :CategoryID
    ";

    $REMOVE_CATEGORY_STMT = $dbHandler -> prepare($REMOVE_CATEGORY);
    $REMOVE_CATEGORY_STMT-> bindParam(":CategoryID", $bTargetCategory, PDO::PARAM_INT);

    try{

        if($REMOVE_CATEGORY_STMT -> execute()){
        
            return true;
        }else{
        
            return false;
        }
    }catch(PDOException $ERR){

        echo "Database error: " . $ERR->getMessage();

        return false;
    }
}