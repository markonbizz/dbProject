<?php

if(($_SERVER["REQUEST_METHOD"] === "POST") && ($_POST["fUpdateUserGeneral"]))
{

    include_once("Database_EstConnection.php");

    $bChangeName        = $_POST["fUpdateName"]; 
    $bChangeEmail       = $_POST["fUpdateEmail"];
    $bChangePhoneNumber = $_POST["fUpdatePhoneNumber"];
    $bChangeAddress     = $_POST["fUpdateAddress"];

    try{

        $SQL_STATMENT = $dbHandler -> prepare("UPDATE `User_Basics` SET `Email` = :Email WHERE `UserID` = :UserID");
        $SQL_STATMENT-> bindParam(":UserID", $_SESSION["UserID"]);
        $SQL_STATMENT-> bindParam(":Email", $bChangeEmail);

        if($SQL_STATMENT-> execute()){

            $USER_PRIVACY = 
            "
                UPDATE 
                    `User_Privacy`
                SET 
                    `RealName`    = :RealName,
                    `PhoneNumber` = :PhoneNumber,
                    `Address`     = :Address
                WHERE
                    `UserID` = :UserID
            ";

            $SQL_STATMENT = $dbHandler -> prepare($USER_PRIVACY);
            $SQL_STATMENT-> bindParam(":UserID"     , $_SESSION["UserID"]);
            $SQL_STATMENT-> bindParam(":RealName"   , $bChangeName);
            $SQL_STATMENT-> bindParam(":PhoneNumber", $bChangePhoneNumber);
            $SQL_STATMENT-> bindParam(":Address"    , $bChangeAddress);
            if($SQL_STATMENT-> execute()){

                echo 
                "
                    <script> 
                        alert('Infomation successfully updated !') 
                        window.location.href = \"UserAccountSettings.php\";
                    </script>
                ";
            }
        }    
    
    }catch(PDOException $e){

        echo "Database Error: " . $e->getMessage();
    }
}