<?php

include_once("Database_EstConnection.php");

$SQL_STATMENT = $dbHandler -> prepare("SELECT TotalBalance FROM User_Basics WHERE UserID = :UserID");
$SQL_STATMENT-> bindParam(":UserID", $_SESSION["UserID"]);
$SQL_STATMENT-> execute();

$User_Basics = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

if($User_Basics){
    
    echo "<h3>$" . $User_Basics["TotalBalance"] . "</h3>";
}