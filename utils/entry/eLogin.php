<?php

function Entry_SectionLogin($LOGIN_STATE){

    $entryOnline = "myAccount.php";
    $entryLogin = "login.php";

    if($LOGIN_STATE){

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entryOnline}\">
                    <i class=\"fa fa-user\"></i> 
                    My Account 
                </a>
            </div>
        ";
    }else{

        echo 
        "
            <div class=\"header__top__right__auth\">
                <a href=\"{$entryLogin}\">
                    <i class=\"fa fa-user\"></i> 
                    Login 
                </a>
            </div>
        ";
    }
}

