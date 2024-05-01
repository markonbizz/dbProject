<?php

function Entry_SectionEmail(){
    
    if(isset($_SESSION["isLogin"])){

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