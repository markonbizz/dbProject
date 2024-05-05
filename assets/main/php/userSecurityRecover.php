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

        echo
        "
            <script>
                alert(\" Reset Successfully: Warning, Lazy mode is used, please switch to Normal mode \");
                window.location.href = \"Login.php\";
            </script>
        ";
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
            $is_reset_success = $stmt->execute();

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
}