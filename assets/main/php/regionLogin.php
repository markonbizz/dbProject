<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function Region_FetchLogin(){

    $entry = 
    [
        "User"      => "AccountInfo.php",
        "Admin"     => "Admin.php",
        "ifLogout"  => "Login.php"
    ];

    if(isset($_SESSION["USER_ACTIVE"]) && ($_SESSION["Permission"] === "ADMIN")){

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entry["Admin"]}\">
                    <i class=\"fa fa-user\"></i> 
                   <strong> My Account </strong>
                </a>
            </div>
        ";
    }elseif(isset($_SESSION["USER_ACTIVE"]) && ($_SESSION["Permission"] === "USER")){

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entry["User"]}\">
                    <i class=\"fa fa-user\"></i> 
                   <strong> My Account </strong>
                </a>
            </div>
        ";
    }else{

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entry["ifLogout"]}\">
                    <i class=\"fa fa-user\"></i> 
                    <strong> Login </strong>
                </a>
            </div>
        ";
    }
}

