<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function Region_FetchEmail(){
    
    if(isset($_SESSION["USER_ACTIVE"])){

        echo"

            <ul>
                <li>Welcome Back, {$_SESSION['Account']} </li>
                <li><i class=\"fa fa-envelope\"></i>{$_SESSION["Email"]}</li>
            </ul>
        ";
    }else{
        echo"

            <ul>
                <li>Welcome, Adventurer</li>
            </ul>
        ";
    }
}