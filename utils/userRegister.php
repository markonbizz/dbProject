<?php

include_once("sessionPaths.php");
include_once("sessionDefines.php");

function User_GenerateUID($_Prefix = "", $_Length = 8){

    // Method By hackan@gmail.com from 7 years ago. :)
    if (function_exists("random_bytes")){

        $bytes_ = random_bytes(ceil($_Length / 2));
    }elseif (function_exists("openssl_random_pseudo_bytes")) {
    
        $bytes_ = openssl_random_pseudo_bytes(ceil($_Length / 2));
    }else{
        
        throw new Exception("no cryptographically secure random function available");
    }

    return ($_Prefix . substr(bin2hex($bytes_), 0, $_Length));
}

function User_GetRegisteration(){

    $dbHandler = Database_Connect();

    if ($_SERVER['REQUEST_METHOD'] === "POST"){

        // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
        // {   //檢查cfrs令牌
        //     die("CSRF Token Validation Failed");
        // }

        $bAccount        = $_POST['fAccount']        ?? "";
        $bRealName       = $_POST['fRealName']       ?? "";
        $bEmail          = $_POST['fEmail']          ?? "";
        $bBirthday       = $_POST['fBirthday']       ?? "";
        $bPhoneNumber    = $_POST['fPhoneNumber']    ?? "";
        $bPassword       = $_POST['fPassword']       ?? "";
        $bPasswordAgain  = $_POST['fPassword_Again'] ?? "";
        
        $errors = '';
        
        if (empty($bAccount)) {
            $errors .= "This credential cannot be empty\\n";
        } else if (strlen($bAccount) < 4 || strlen($bAccount) > 24) {
            $errors .= "Account length must at Least 4 characters and not exceed 24\\n";
        }
        
        if (empty($bRealName)) {
            $errors .= "This credential cannot be empty!\\n";
        } else if (strlen($bRealName) < 2 || strlen($bRealName) > 24) {
            $errors .= "Name must at Least 2 characters and not exceed 24\\n";
        }
        
        if (empty($bEmail)) {
            $errors .= "This credential cannot be empty!\\n";
        } else if (strlen($bEmail) < 4 || strlen($bEmail) > 50) {
            $errors .= "Email length length must at Least 4 characters and not exceed 50\\n";
        }

        if (empty($bPhoneNumber)) {
            $errors .= "Phone Number cannot be empty\\n";
        } else if (strlen($bPhoneNumber) != 10) {
            $errors .= "Phone Number must equal 10 numbers\\n";
        }

        if (empty($bBirthday)) { //證實生日的格式
            $errors .= "This credential cannot be empty\\n";
        } 
        
        if (empty($bPassword)) {
            $errors .= "This credential cannot be empty\\n";
        } else if (strlen($bPassword) < 4 || strlen($bPassword) > 50) {
            $errors .= "Password length must at Least 4 characters and not exceed 50\\n";
        }
        
        if (empty($bPasswordAgain)) {
            $errors .= "This credential cannot be empty!\\n";
        } else if ($bPassword != $bPasswordAgain) {
            $errors .= "Password is Not Matched\\n";
        } else if (strlen($bPasswordAgain) < 4 || strlen($bPasswordAgain) > 50) {
            $errors .= "Password length must at Least 4 characters and not exceed 50\\n";
        }

        if(empty($errors)){
            $checkUser = $dbHandler->prepare("SELECT COUNT(*) FROM Users WHERE Account = :Account");
            $checkUser -> bindParam(':Account', $bAccount);
            $checkUser -> execute();

            if($checkUser->fetchColumn() > 0) $errors.= "This account has been registered\\n";

            $checkEmail = $dbHandler->prepare("SELECT COUNT(*) FROM Users WHERE Email = :Email");
            $checkEmail -> bindParam(':Email', $bEmail);
            $checkEmail -> execute();

            if($checkEmail->fetchColumn() > 0) $errors.= "This email has been registered\\n";
        }

        //echo "<script>alert('+$role+'\n'+$userRealName+'\n'+$email+'\n'+$phoneNumber+'\n'+$bloodType+'\n'+$birthday+'\n'+$username +'\n'+ $password+');</script>";
        
        if (!empty($errors)) echo "<script>alert('$errors');</script>";
        else {
            if (!empty($bPassword) && (strlen($bPassword)>=4) && (strlen($bPassword)<=50)) {
                $bHashedPSWD = password_hash($bPassword, PASSWORD_DEFAULT);
                // echo "<script>
                // 		alert('密碼加密');
                // 	</script>";
            }

            try {
                $stmt = $dbHandler->prepare("INSERT INTO 
                                             Users (UID, Permission, RealName, Email, PhoneNumber, Birthday, Account, Password) 
                                                    VALUES 
                                                   (:UID, :Permission, :RealName, :Email, :PhoneNumber, :Birthday, :Account, :Password)");
                
                $bUserID     = User_GenerateUID();
                $bPermission = 'USER';

                $stmt->bindParam(':UID'         , $bUserID);
                $stmt->bindParam(':Permission'  , $bPermission);
                $stmt->bindParam(':RealName'    , $bRealName);
                $stmt->bindParam(':Email'       , $bEmail);
                $stmt->bindParam(':PhoneNumber' , $bPhoneNumber);
                $stmt->bindParam(':Birthday'    , $bBirthday);
                $stmt->bindParam(':Account'     , $bAccount);
                $stmt->bindParam(':Password'    , $bHashedPSWD);
                $is_reg_success = $stmt->execute();
            
                if($is_reg_success){
                    echo
                    "
                        <script>
                            alert(\" Login Successfully ! \");
                            window.location.href = \"index.php\";
                        </script>
                    ";
                }

            } catch (PDOException $e) {
                echo "Database Error: " . $e->getMessage();
            }
        }
    }

};