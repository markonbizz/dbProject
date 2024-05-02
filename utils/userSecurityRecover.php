<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

include_once("dbConnect.php");

$dbHandler = Database_Connect();

function User_ResetPassword_Lazy(){

    // Init connection of database
    global $dbHandler;

    if($_SESSION["bAccount"]){

        $bHashedPassword = password_hash($_SESSION["bAccount"], PASSWORD_DEFAULT);

        $stmt = $dbHandler->prepare("UPDATE Users SET Password=:Password WHERE Account=:Account");
        $stmt->bindParam(':Account', $_SESSION["bAccount"]);
        $stmt->bindParam(':Password', $bHashedPassword);
        $stmt->execute();

        header("Location: Login.php");
    }
}

function User_VerifyAccount($mode = "normal"){

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
        // Init connection of database
        global $dbHandler;

        // Get credentials info
        $bAccount = $_POST["fAccount"] ?? "";
        $bEmail   = $_POST["fEmail"]   ?? "";

        // Binding info to search equal value in db.
        $stmt = $dbHandler->prepare("SELECT * FROM Users WHERE Account = :Account");
        $stmt->bindParam(':Account', $bAccount);
        $stmt->execute();

        // Return matched target to the var.
        $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION["bAccount"] = $targetUser["Account"];

        if(($targetUser['Account'] == $bAccount) && ($targetUser['Email'] == $bEmail)){

            if($mode === "lazy"){

                User_ResetPassword_Lazy();
            }else{

                header("Location: ResetPassword.php");
            }
        } else {
            
            echo "<script type=\"javascript\"> alert(\"Verification Failed\"); </script>";

            header("Location: ForgotPassword.php");
        }
    }
}

function User_ResetPassword(){

    // Init connection of database
    global $dbHandler;

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        // Get credentials info
        $bNewPassword       = $_POST["fNewPassword"]        ?? "";
        $bNewPassword_Again = $_POST["fNewPassword_Again"]  ?? "";

        if($bNewPassword_Again == $bNewPassword){

            $bHashedPassword = password_hash($bNewPassword, PASSWORD_DEFAULT);

            $stmt = $dbHandler->prepare("UPDATE Users SET Password=:Password WHERE Account=:Account");
            $stmt->bindParam(':Account', $_SESSION["bAccount"]);
            $stmt->bindParam(':Password', $bHashedPassword);
            $stmt->execute();

            header("Location: Login.php");
            
        }else{
        
            echo "<script type=\"javascript\"> alert(\"Password is not matched\"); </script>";
        }
    }
}