<?php

include "dbUtils.php";

$dbHandler = new Database("localhost:3306", "root", "#u2324");

class LoginSession{

    private $userAccount = "";
    private $userPassword = "";
    private $targetUser = null;

    public function GetCredentialInfo(){

        global $dbHandler;

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $DB_LOCAL = $dbHandler->EstConnectionTo("DEArmory");

            $this->userAccount  = $_POST['userAccount']  ?? "";
            $this->userPassword = $_POST['userPassword'] ?? "";

            $stmt = $DB_LOCAL->prepare("SELECT * FROM User WHERE Account = :Account");
            $stmt->bindParam(":Account", $this->userAccount);
            $stmt->execute();

            $this->targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function VerifyCredentialInfo(){
        
        if(($this->targetUser) && (password_verify($this->userPassword, $this->targetUser["Password"]))){

            $_SESSION["ID"]         = $this->targetUser['ID']; 
            $_SESSION["Account"]    = $this->targetUser['Account']; 
            $_SESSION["Email"]      = $this->targetUser['Email']; 
            $_SESSION["Permission"] = $this->targetUser["Permission"];

            if($_SESSION["Permission"] == "ADMIN"){

                header('Location: index.php');
            } else {
            
                header('Location: index.php'); 
            }
        
            exit();
        }else{
            // 登入失敗以及錯誤訊息
            echo "<script>alert('使用者名稱或密碼錯誤');</script>";
        
            
        }
    }
};