<?php

function Session_CheckAuthLevel(string $checkAuth = "USER", string $redirect_dst = "Login.php", bool $active = true){

    if($active)
    {
        if(!($_SESSION["UserID"]) && !(isset($_SESSION["UserID"]))){

            echo
            '
                <script>
                    alert("Caution: Anonymously User Detected, Redirecting to Login Page...");
                    window.location.href = "' . $redirect_dst . '"
                </script>
            ';
        }else if(($_SESSION["Permission"] !== $checkAuth) && !(isset($_SESSION["Permission"]))){
        
            echo
            '
                <script>
                    alert("Caution: Unauthorized Access Detected, Redirecting to Login Page...");
                    window.location.href = "' . $redirect_dst . '"
                </script>
            ';
        }
    }
}