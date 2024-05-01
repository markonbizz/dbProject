<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
}

function User_SessionDestory(){

    session_start();

    $redirect_dst = "../../index.php";

    if (ini_get("session.use_cookies")){

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]);
    }   

    if((isset($_SESSION["isLogin"]))){

        $_SESSION["isLogin"] = null;
        header("Location: {$redirect_dst}");
    }

    session_destroy();

    echo "<script>alert('Logout Successfully!');</>";

    exit();
}

User_SessionDestory();