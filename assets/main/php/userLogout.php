<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function User_LogoutSession(){

    session_start();

    $redirect_dst = "../../../index.php";

    if (ini_get("session.use_cookies")){

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]);
    }   

    if((isset($_SESSION["USER_ACTIVE"]))){

        $_SESSION["USER_ACTIVE"] = null;
        
        echo 
        "
            <script>
                alert(\" Logout Successfully ! \");
                window.location.href = \"{$redirect_dst}\";
            </script>
        ";
    }

    session_destroy();

    exit();
}

User_LogoutSession();