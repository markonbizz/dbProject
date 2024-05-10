<?php

if($_SESSION["bAccount"]){

    include_once("Database_EstConnection.php");

    $bHashedPassword = password_hash($_SESSION["bAccount"], PASSWORD_DEFAULT);

    $SQL_STATMENT = $dbHandler->prepare("UPDATE User_Privacy SET Password = :Password WHERE UserID = :UserID");
    $SQL_STATMENT-> bindParam(':Account', $_SESSION["bUserID"]);
    $SQL_STATMENT-> bindParam(':Password', $bHashedPassword);
    if($SQL_STATMENT -> execute()){

        unset($_SESSION["bUserID"]);        

        echo
        "
            <script>
                alert(\" Reset Successfully \");
                alert(\" Warning: Fast Mode is used, please switch to Normal Mode \");
                window.location.href = \"Login.php\";
            </script>
        ";
    }
}