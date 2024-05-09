<?php

$trans_success = false;

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    include_once("Database_EstConnection.php");

    $bTranscation = intval($_POST["fTranscation"]);

    try{

        $SQL_STATEMENT = $dbHandler->prepare("SELECT TotalBalance FROM User_Basics WHERE Account = :Account");
        $SQL_STATEMENT->bindParam(":Account", $_SESSION["Account"]);
        $SQL_STATEMENT->execute();

        $userBalance = $SQL_STATEMENT->fetch(PDO::FETCH_ASSOC);
        $currentBalance = $userBalance["TotalBalance"];

        // Calculate the new balance by adding the transaction amount
        $newBalance = $currentBalance + $bTranscation;

        // Update the TotalBalance in the database
        $SQL_STATEMENT = $dbHandler->prepare('UPDATE User_Basics SET TotalBalance = :NewBalance WHERE Account = :Account');
        $SQL_STATEMENT->bindParam(":NewBalance", $newBalance);
        $SQL_STATEMENT->bindParam(":Account", $_SESSION["Account"]);
        echo 
        "
            <script> alert('Transcation successfully added !') </script>
        ";
    }catch(PDOException $e){

        echo "Database Error: " . $e->getMessage();
    }
}