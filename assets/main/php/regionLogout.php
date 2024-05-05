<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function Region_FetchLogout(){

    $executeScript = _UTILITIES_PATH_ . "userLogout.php";

    if(isset($_SESSION["USER_ACTIVE"])){

        echo
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$executeScript}\"><i class=\"fa fa-sign-out\"></i>
                    Logout
                </a>
            </div>
        ";
    }
}