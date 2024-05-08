<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){

    include_once("Database_EstConnection.php");

    // Get credentials info
    $bNewPassword       = $_POST["fNewPassword"]        ?? "";
    $bNewPassword_Again = $_POST["fNewPassword_Again"]  ?? "";

    if($bNewPassword_Again == $bNewPassword){

        $bHashedPassword = password_hash($bNewPassword, PASSWORD_DEFAULT);

        $SQL_STATMENT = $dbHandler->prepare("UPDATE Users SET Password=:Password WHERE Account=:Account");
        $SQL_STATMENT -> bindParam(':Account', $_SESSION["bAccount"]);
        $SQL_STATMENT -> bindParam(':Password', $bHashedPassword);
        $is_reset_success = $SQL_STATMENT->execute();

        if($is_reset_success){

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