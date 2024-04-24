<?php

include "../db/InitDBConnection.php";

$userAccount = "";
$userEmail = "";
$userPassword = "";

function initialize_session(){

    global $userAccount,
           $userEmail,
           $userPassword;

    if($_SERVER['REQUEST_METHOD'] === "POST"){
                                                        
        // "??" similar to "?:", return if first element is existed, otherwise return null/ sth.
        $userEmail = ($_POST["clientemail"] ?? "");     // return content of "clientemail", otherwise nothing.
        $userPassword = ($_POST["clientpasswd"] ?? ""); // return content of "clientpasswd", otherwise nothing.
    
        $STMT = $db -> prepare("SELECT * FROM users WHERE username = :username");
        $STMT -> bindParam(':username', $userAccount);
        $STMT -> execute();
    }
}