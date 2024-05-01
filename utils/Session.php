<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
} 

// User Utilities
include_once(WEB_ROOTPATH . "utils/user/uLogin.php");
include_once(WEB_ROOTPATH . "utils/user/uLogout.php");
include_once(WEB_ROOTPATH . "utils/user/uRegister.php");

// Entry Display Utilities
include_once(WEB_ROOTPATH . "utils/entry/eLogin.php");
include_once(WEB_ROOTPATH . "utils/entry/eLogout.php");