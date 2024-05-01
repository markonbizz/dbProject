<?php

function Entry_SectionLogout($LOGIN_STATE){

    $entry = "myAccount.php";

    if($LOGIN_STATE){

        echo
        "
            <div class=\"header__top__right__auth\">
                <a href=\"<?php WEB_ROOTPATH\.\"utils/user/uLogout.php\" ?>\"><i class=\"fa fa-sign-out\"></i>
                    Logout
                </a>
            </div>
        ";
    }
}