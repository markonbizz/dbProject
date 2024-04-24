<?php

include "dbUtils.php";

$dbHandler = new Database("localhost:3306", "root", "#u2324");

class Login{

    private $userAccount = "";
    private $userPassword = "";
    private $targetUser = null;

    public function GetClientInfomation(){

        global $dbHandler;

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $DB_LOCAL = $dbHandler->EstablishConnection("DEArmory");

            $this->userAccount  = $_POST['userAccount']  ?? "";
            $this->userPassword = $_POST['userPassword'] ?? "";

            $stmt = $DB_LOCAL->prepare("SELECT * FROM Users WHERE Account = :Account");
            $stmt->bindParam(":Account", $this->userAccount);
            $stmt->execute();

            $this->targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function VerifyClientInfomation(){
        
        if(($this->targetUser) && (password_verify($this->userPassword, $this->targetUser["Password"]))){

            

        }
    }
};