<?php

$executeScript = _UTILITIES_PATH_ . "Session_Logout.php";

if(isset($_SESSION["Account"])){

    echo
    "
        <div class=\"header__top__right__auth\">
            <a href=\"{$executeScript}\">
                <i class=\"fa fa-sign-out\"></i>
                <strong> Logout </strong>
            </a>
        </div>
    ";
}