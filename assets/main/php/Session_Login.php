<?php

// Fetch Database's Infomation
if($_SERVER['REQUEST_METHOD'] === "POST")
{

    include_once("Database_EstConnection.php");

    $bAccount  = $_POST['fAccount']  ?? '';
    $bPassword = $_POST['fPassword'] ?? '';

    // Look up the user in login credential.
    $SQL_STATMENT = $dbHandler -> prepare("SELECT * FROM Users WHERE Account = :Account");
    $SQL_STATMENT -> bindParam(':Account', $bAccount);
    $SQL_STATMENT -> execute();

    $targetUser = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

    

/* ================================================================================================ */

    // Verify & Login

    if(!($targetUser)){
        echo 
        "
            <script>
                alert(\" Login Failed: Invalid User or Password \");
                window.location.href = \"Login.php\";
            </script>
        "; 
    }else if(($targetUser) && !password_verify($bPassword, $targetUser["Password"])){

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

        $_SESSION["Account"]    = $targetUser["Account"];
        $_SESSION["Email"]      = $targetUser["Email"];
        $_SESSION["Permission"] = $targetUser["Permission"];

        if(isset($_SESSION["Account"]) && ($targetUser["Permission"] == "ADMIN")){

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