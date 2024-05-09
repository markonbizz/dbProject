<?php

function _logout_(){

    $redirect_dst = "../index.php";

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
}

function Session_CheckAuthLevel(string $checkAuth, string $checkStatus = "login"){

    if(!isset($_SESSION["Account"]) && ($checkStatus === "login")){

        echo 
        "
            <script>
                alert('No login status detectd, redirect to main page.');
            </script>
        ";
        
        _logout_();
    }else if((isset($_SESSION["Account"])) && ($_SESSION["Permission"] !== $checkAuth)){

        echo 
        "
            <script>
                alert('Unauthorized access detectd, redirect to main page.'); 
            </script>
        ";
        
        _logout_();
    }
}