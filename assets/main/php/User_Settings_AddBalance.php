<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    include_once("Database_EstConnection.php");

    $bTranscation = $_POST["fTranscation"];

    try{

        $SQL_STATMENT = $dbHandler->prepare("SELECT TotalBalance FROM User_Basics WHERE Account = :Account");
        $SQL_STATMENT-> bindParam(":Account", $_SESSION["Account"]);
        $SQL_STATMENT-> execute();

        $userBalance = $SQL_STATMENT->fetch(PDO::FETCH_ASSOC);
        $userBalance["TotalBalance"] += intval($bTranscation); 

        $SQL_STATMENT = $dbHandler->prepare('UPDATE User_Basics SET TotalBalance = \'$userBalance[TotalBalance]\'');
        $SQL_STATMENT-> execute();

    }catch(PDOException $e){

        echo "Database Error: " . $e->getMessage();
    }
}