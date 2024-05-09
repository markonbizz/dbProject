<?php

// Fetch Database's Infomation
if($_SERVER['REQUEST_METHOD'] === "POST")
{

    include_once("Database_EstConnection.php");

    $bAccount  = $_POST['fAccount']  ?? '';
    $bPassword = $_POST['fPassword'] ?? '';

    // Look up the user in login credential.
    $SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM User_Basics WHERE Account = :Account");
    $SQL_STATMENT -> bindParam(':Account', $bAccount);
    $SQL_STATMENT -> execute();
    $User_Basics = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

    $SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM User_Security WHERE UserID = :UserID");
    $SQL_STATMENT -> bindParam(':UserID', $User_Basics["UserID"]);
    $SQL_STATMENT -> execute();
    $User_Security = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

/* ================================================================================================ */

    // Verify & Login
    if(!(password_verify($bPassword, $User_Security["Password"])) || !($User_Basics) || !($User_Security)){
        
        echo 
        "
            <script>
                alert(\" Login Failed: Invalid User or Password \");
                window.location.href = \"Login.php\";
            </script>
        "; 
    }else{
    
        /*
            Using "$_SESSION" to store user infomation to "Make Sure" the user is existed.
            
            Furthermore, "$_SESSION" is a "Pre Defined" global variable, which its scope is
            "System-Wide". 
        */

        $_SESSION["UserID"]     = $User_Security["UserID"];
        $_SESSION["Account"]    = $User_Basics["Account"];
        $_SESSION["Email"]      = $User_Basics["Email"];
        $_SESSION["Permission"] = $User_Security["Permission"];


        if(isset($_SESSION["Account"]) && ($User_Security["Permission"] === "ADMIN")){

            echo 
            "
                <script>
                    alert(\" Login Successfully ! \");
                    window.location.href = \"AdminHome.php\";
                </script>
            ";
        }else{

            echo 
            "
                <script>
                    alert(\" Login Successfully ! \");
                    window.location.href = \"index.php\";
                </script>
            "; 
        }
    }
}