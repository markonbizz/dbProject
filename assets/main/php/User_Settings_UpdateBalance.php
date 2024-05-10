<?php

if(($_SERVER["REQUEST_METHOD"] === "POST") && ($_POST["fUpdateUserBalance"] == true))
{
    include_once("Database_EstConnection.php");

    $bTranscation = intval($_POST["fTranscation"]);

    try{

        $SQL_STATEMENT = $dbHandler->prepare("SELECT TotalBalance FROM User_Basics WHERE Account = :Account");
        $SQL_STATEMENT->bindParam(":Account", $_SESSION["Account"]);
        $SQL_STATEMENT->execute();

        $userBalance = $SQL_STATEMENT->fetch(PDO::FETCH_ASSOC);

        // Calculate the new balance by adding the transaction amount
        $bTranscation = $userBalance["TotalBalance"] + $bTranscation;

        // Update the TotalBalance in the database
        $SQL_STATEMENT = $dbHandler->prepare('UPDATE User_Basics SET TotalBalance = :NewBalance WHERE UserID = :UserID');
        $SQL_STATEMENT->bindParam(":NewBalance", $bTranscation);
        $SQL_STATEMENT->bindParam(":UserID", $_SESSION["UserID"]);
        if($SQL_STATEMENT->execute())
        {
            echo 
            "
                <script> alert('Transcation successfully added !') </script>
            ";
        }

    }catch(PDOException $e){

        echo "Database Error: " . $e->getMessage();
    }
}