<?php

/*
    NOTE: In "Renderer", "tags" and "functions" will be projected to the front, 
          which the path will become "/var/www/html" relatively.
*/

namespace Render;

class Store{

    private function TopBar_Right_UserLogin(){

        $entry = 
        [
            "User"      => "UserHome.php",
            "Admin"     => "AdminHome.php",
            "ifLogout"  => "Login.php"
        ];

        if(isset($_SESSION["Account"]) && ($_SESSION["Permission"] === "ADMIN")){

            echo 
            "
                <div class=\"header__top__right__auth\">
                    <a href=\"{$entry["Admin"]}\">
                        <i class=\"fa fa-user\"></i> 
                    <strong> My Account </strong>
                    </a>
                </div>
            ";
        }elseif(isset($_SESSION["Account"]) && ($_SESSION["Permission"] === "USER")){

            echo 
            "
                <div class=\"header__top__right__auth\">
                    <a href=\"{$entry["User"]}\">
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

    private function TopBar_Right_UserLogout(){
        
        $executeScript = _UTILITIES_PATH_ . "userLogout.php";

        if(isset($_SESSION["Account"])){

            echo
            "
                <div class=\"header__top__right__auth\">
                    <a href=\"\">
                        <i class=\"fa fa-sign-out\"></i>
                        <strong> Logout </strong>
                    </a>
                </div>
            ";
        }
    }

    // =============================================================== //

    public function TopBar_Left_Welcome(){

        if(isset($_SESSION["Account"])){

            echo"

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
            echo"

                <ul>
                    <li>
                        Welcome, <strong> Adventurer </strong>
                    </li>
                </ul>
            ";
        }
    }

    public function TopBar_Right_UserUtilities(){

        self::TopBar_Right_UserLogin();

        echo "&nbsp";
        echo "&nbsp";

        self::TopBar_Right_UserLogout();
    }
};

class User{

};