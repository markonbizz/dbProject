<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){

    include_once("Database_EstConnection.php");

    // Get credentials info
    $bNewPassword       = $_POST["fNewPassword"]        ?? "";
    $bNewPassword_Again = $_POST["fNewPassword_Again"]  ?? "";

    if($bNewPassword_Again == $bNewPassword){

        $bHashedPassword = password_hash($bNewPassword, PASSWORD_DEFAULT);

        $SQL_STATMENT = $dbHandler->prepare("UPDATE User_Security SET Password = :Password WHERE UserID = :UserID");
        $SQL_STATMENT -> bindParam(':UserID', $_SESSION["bUserID"]);
        $SQL_STATMENT -> bindParam(':Password', $bHashedPassword);
        
        if($SQL_STATMENT->execute()){

            unset($_SESSION["bUserID"]);

            echo
            "
                <script>
                    alert(\" Reset Successfully \");
                    window.location.href = \"Login.php\";
                </script>
            ";   
        }
        
    }else{

        echo 
        "
            <script>
                alert(\"Reset Failed: Password is not matched\");
            </script>
        ";
    }
}