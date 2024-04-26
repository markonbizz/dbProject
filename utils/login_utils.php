<?php

include "db_utils.php";

function Verify_CredentialInfo(){

    global $dbHandler;

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $dbHandler = EstConnection();

        $account  = $_POST['userAccount']  ?? '';
        $password = $_POST['userPassword'] ?? '';

        $stmt = $dbHandler->prepare("SELECT * FROM User WHERE Account = :Account");
        $stmt->bindParam(':Account', $account);
        $stmt->execute();

        $tgtUser = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<script>alert('". $tgtUser["Account"] ."')</script>";

        if ($tgtUser && $password == $tgtUser['Password']) {
      
            $_SESSION['ID']         = $tgtUser['ID']; 
            $_SESSION['Account']    = $tgtUser['Account']; 
            $_SESSION['Email']      = $tgtUser['Email']; 
            $_SESSION['Permission'] = $tgtUser['Permission'];

            if($_SESSION['Permission'] == "ADMIN"){
            
                header('Location: ../index.php');
            }else{

                header('Location: ../contact.php'); 
            }
        
            exit();
        } else {

            // 登入失敗以及錯誤訊息
            echo "<script>alert('Invalid user name or password');</>";
        }
    }
}