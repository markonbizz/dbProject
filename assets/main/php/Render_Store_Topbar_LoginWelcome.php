<?php

if(isset($_SESSION["Account"])){

    echo
    "
        <ul>
            <li>
                Welcome Back, <strong> {$_SESSION['Account']} </strong> 
            </li>
            <li>
                <i class=\"fa fa-envelope\"></i>
                <strong> {$_SESSION["Email"]} </strong>
            </li>
        </ul>
    ";
}else{

    echo
    "
        <ul>
            <li>
                Welcome, <strong> Adventurer </strong>
            </li>
        </ul>
    ";
}