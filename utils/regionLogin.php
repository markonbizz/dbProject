<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function Region_FetchLogin(){

    $entries = 
    [
        "Manage" => "ManageAccount.php",
        "ifLogout" => "Login.php"
    ];

    if(isset($_SESSION["USER_ACTIVE"])){

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entries["Manage"]}\">
                    <i class=\"fa fa-user\"></i> 
                    My Account 
                </a>
            </div>
        ";
    }else{

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entries["ifLogout"]}\">
                    <i class=\"fa fa-user\"></i> 
                    Login 
                </a>
            </div>
        ";
    }
}

