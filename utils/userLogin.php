<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

include_once("dbConnect.php");

function User_LoginSession(){

    $dbHandler = Database_Connect();

    if ($_SERVER['REQUEST_METHOD'] === "POST"){

        $bAccount  = $_POST['fAccount']  ?? '';
        $bPassword = $_POST['fPassword'] ?? '';

        $stmt = $dbHandler->prepare("SELECT * FROM Users WHERE Account = :Account");
        $stmt->bindParam(':Account', $bAccount);
        $stmt->execute();

        $bTargetUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (($bTargetUser) && password_verify($bPassword, $bTargetUser['Password'])){ ;
      
            echo
			"
				<script> alert('Login Successfully'); </script>;
			";
            
            $_SESSION['ID']         = $bTargetUser['ID']; 
            $_SESSION['Account']    = $bTargetUser['Account']; 
            $_SESSION['Email']      = $bTargetUser['Email']; 
            $_SESSION['Permission'] = $bTargetUser['Permission'];

            if($_SESSION['Permission'] == "ADMIN"){
                
                if(!isset($_SESSION["USER_ACTIVE"]) || empty($_SESSION["USER_ACTIVE"])){
                
                    $_SESSION["USER_ACTIVE"] = true;
                }
                    
                header('Location: index.php');
            }else{

                if(!isset($_SESSION["USER_ACTIVE"]) || empty($_SESSION["USER_ACTIVE"])){
                
                    $_SESSION["USER_ACTIVE"] = true;
                }

                header('Location: Contact.php'); 
            }

            exit();
        } else {
            // 登入失敗以及錯誤訊息
            echo
            "
                <script> alert('Login Failed'); </script>;
            ";
        }
    }
}