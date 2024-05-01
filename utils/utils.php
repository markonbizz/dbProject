<?php

/*
    CAUTION: 
        DO NOT INCLUDE THIS FILE TO OTHER UTILITIES, OTHERWISE IT CAUSES FILE COLLISIONS.
        USE ONLY FOR INDIVIDUAL PAGE FOR MAXIMUM COMPABILITY.
*/

/* Database */
    include_once("dbConnect.php");


/* User */
    include_once("userLogin.php");
    //  include_once("userLogout");             // Used Internally By "regionLogout.php"
    include_once("userRegister.php");
    //  include_once("userResetPassword.php");  // Currently Not Finished


/* Region */
    include_once("regionLogin.php");
    include_once("regionEmail.php");
    include_once("regionLogout.php");