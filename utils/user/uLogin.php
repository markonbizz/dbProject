<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
}

include_once(WEB_ROOTPATH . "utils/GLOBAL_DEFINES.php");
include_once(WEB_ROOTPATH . "utils/database/dConnect.php");

function User_VerifyLogin(){

    $dbHandler = DB_EstConnection();

    if ($_SERVER['REQUEST_METHOD'] === "POST"){

        $bAccount  = $_POST['fAccount']  ?? '';
        $bPassword = $_POST['fPassword'] ?? '';

        $stmt = $dbHandler->prepare("SELECT * FROM User WHERE Account = :Account");
        $stmt->bindParam(':Account', $bAccount);
        $stmt->execute();

        $bTargetUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (($bTargetUser) && password_verify($bPassword, $bTargetUser['Password'])){ ;
      
            $_SESSION['ID']         = $bTargetUser['ID']; 
            $_SESSION['Account']    = $bTargetUser['Account']; 
            $_SESSION['Email']      = $bTargetUser['Email']; 
            $_SESSION['Permission'] = $bTargetUser['Permission'];

            if($_SESSION['Permission'] == "ADMIN"){
                
                if(!isset($_SESSION["isLogin"]) || empty($_SESSION["isLogin"])){
                
                    $_SESSION["isLogin"] = true;
                }
                    
                header('Location: index.php');
            }else{

                if(!isset($_SESSION["isLogin"]) || empty($_SESSION["isLogin"])){
                
                    $_SESSION["isLogin"] = true;
                }

                header('Location: contact.php'); 
            }
        
            exit();
        } else {
            // 登入失敗以及錯誤訊息
            echo "<script>alert('Invalid user name or password');</>";
        }
    }
}