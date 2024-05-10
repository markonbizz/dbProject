<?php

if(($_SERVER["REQUEST_METHOD"] === "POST") && ($_POST["fUpdateUserPassword"]))
{

    include_once("Database_EstConnection.php");

    // Get credentials info
    $bOldPasswordVerify     = $_POST["fOldPasswordVerify"]      ?? "";
    $bChangePassword        = $_POST["fUpdatePassword"]         ?? "";
    $bChangePassword_Again  = $_POST["fUpdatePassword_Again"]   ?? "";

    $SQL_STATMENT = $dbHandler->prepare("SELECT `Password` FROM `User_Security` WHERE `UserID` = :UserID");
    $SQL_STATMENT-> bindParam(':UserID', $_SESSION["bUserID"]);

    try{

        $SQL_STATMENT -> execute();
        $User_Security = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

        if(password_verify($bOldPasswordVerify, $User_Security["Password"]) && ($bChangePassword == $bChangePassword_Again)){

            $bHashedPassword = password_hash($bChangePassword, PASSWORD_DEFAULT);

            $SQL_STATMENT = $dbHandler->prepare("UPDATE `User_Security` SET `Password` = :Password WHERE `UserID` = :UserID");
            $SQL_STATMENT -> bindParam(':UserID', $_SESSION["bUserID"]);
            $SQL_STATMENT -> bindParam(':Password', $bHashedPassword);
            
            try{

                if($SQL_STATMENT->execute()){
                    
                    echo
                    "
                        <script>
                            alert(\" Password is successfully changed \");
                            window.location.href = \"UserAccountSettings.php\";
                        </script>
                    ";
                }
            }catch(PDOException $e){

                echo "Database Error: " . $e->getMessage();
            }
        }else{

            echo 
            "
                <script>
                    alert(\"Verification Failed: Current password is not matched\");
                </script>
            ";
        }
    }catch(PDOException $e){

        echo "Database Error: " . $e->getMessage();   
    }
}