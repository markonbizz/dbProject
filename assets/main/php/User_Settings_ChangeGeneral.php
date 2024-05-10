<?php

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {

        include_once("Database_EstConnection.php");

        if(!empty($_POST["fChangeGeneralForm"]))
        {
            $bChangeName    = $_POST["fChangeName"]; 
            $bChangeEmail   = $_POST["fChangeEmail"];
            $bChangeAddress = $_POST["fChangeAddress"];

            $SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM User_Basics WHERE Account = :Account");
            $SQL_STATMENT-> bindParam(":Account", $_SESSION["Account"]);
            $SQL_STATMENT-> execute();
            $User_Basics = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

            $SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM User_Privacy WHERE UserID = :UserID");
            $SQL_STATMENT-> bindParam(":UserID", $_SESSION["UserID"]);
            $SQL_STATMENT-> execute();
            $User_Privacy = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

            try{


            }catch(PDOException $e){

                echo "Database Error: " . $e->getMessage();
            }
        }
    }