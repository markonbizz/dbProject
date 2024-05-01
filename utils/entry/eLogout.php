<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
}

function Entry_SectionLogout(){

    $entry = "utils/user/uLogout.php";

    if(isset($_SESSION["isLogin"])){

        echo
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entry}\"><i class=\"fa fa-sign-out\"></i>
                    Logout
                </a>
            </div>
        ";
    }
}