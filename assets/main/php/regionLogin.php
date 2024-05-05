<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function Region_FetchLogin(){

    $entry = 
    [
        "Manage" => "Admin.php",
        "ifLogout" => "Login.php"
    ];

    if(isset($_SESSION["USER_ACTIVE"])){

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entry["Manage"]}\">
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

