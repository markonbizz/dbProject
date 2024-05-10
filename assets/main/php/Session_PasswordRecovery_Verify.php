<?php

$RESET_MODE = "normal";

if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
    include_once("Database_EstConnection.php");
    
    // Get credentials info
    $bAccount = $_POST["fAccount"] ?? "";
    $bEmail   = $_POST["fEmail"]   ?? "";

    // Binding info to search equal value in db.
    $SQL_STATMENT = $dbHandler->prepare("SELECT * FROM User_Basics WHERE Account = :Account");
    $SQL_STATMENT ->bindParam(':Account', $bAccount);
    $SQL_STATMENT ->execute();

    // Return matched target to the var.
    $targetUser = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

/* ================================================================================================ */

    $_SESSION["bUserID"] = $targetUser["UserID"];

    if(($targetUser['Account'] == $bAccount) && ($targetUser['Email'] == $bEmail)){

        if($RESET_MODE === "fast"){

            include_once("Session_PasswordRecovery_FastReset.php");
        }else{

            echo
            "
                <script>
                    alert(\" Verification Successfully \");
                    window.location.href = \"ResetPassword.php\";
                </script>
            ";
        }
    } else {

        echo
        "
            <script>
                alert(\" Verification Failed: User is not found or wrong email. \");
                window.location.href = \"ForgotPassword.php\";
            </script>
        ";
    }
}