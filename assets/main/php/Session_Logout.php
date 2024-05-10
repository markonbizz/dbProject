<?php

session_start();

$redirect_dst = "../../../Login.php";

if (ini_get("session.use_cookies")){

    $params = session_get_cookie_params();

    setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
}   

if((isset($_SESSION["Account"]))){

    $_SESSION = array();
    
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