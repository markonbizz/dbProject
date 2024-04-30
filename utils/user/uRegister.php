<?php

if(!defined("WEB_ROOTPATH")){
    define("WEB_ROOTPATH", "/var/www/html/");
}

include_once(WEB_ROOTPATH . "utils/GLOBAL_DEFINES.php");

function User_Register(){

    if (!isset($_SESSION['token_CSRF'])) $_SESSION['token_CSRF'] = bin2hex(random_bytes(32));

    $dbHandler = DB_EstConnection();

    if ($_SERVER['REQUEST_METHOD'] === "POST"){

        if (!isset($_POST['token_CSRF']) || $_POST['token_CSRF'] !== $_SESSION['token_CSRF'])
        {   //檢查cfrs令牌
            exit("CSRF Token Validation Failed");
        }

        $bRealName       = $_POST['fRealName']       ?? "";
        $bEmail          = $_POST['fEmail']          ?? "";
        $bBirthday       = $_POST['fBirthday']       ?? "";
        $bPhoneNumber    = $_POST['fbPhoneNumber']   ?? "";
        $bAccount        = $_POST['fAccount']        ?? "";
        $bPassword       = $_POST['fPassword']       ?? "";
        $bPasswordAgain  = $_POST['fPassword_Again'] ?? "";
        
        $errors = '';
        if (empty($bRealName)) {
            $errors .= "This credential cannot be empty!\\n";
        } else if (strlen($bRealName) < 2 || strlen($bRealName) > 24) {
            $errors .= "使用者姓名的長度必須至少2個字元且少於24個字元\\n";
        }
        
        if (empty($bEmail)) {
            $errors .= "This credential cannot be empty!\\n";
        } else if (strlen($bEmail) < 4 || strlen($bEmail) > 50) {
            $errors .= "電子郵箱的長度必須至少4個字元且少於50個字元\\n";
        }

        if (empty($phoneNumber)) {
            $errors .= "手機號碼不得為空\\n";
        } else if (strlen($bEmail) != 10) {
            $errors .= "手機號碼的長度必須等於10個字元\\n";
        }

        if (empty($birthday)) { //證實生日的格式
            $errors .= "生日錯誤，你不可能在今天或或是未來出生\\n";
        } 

        if (empty($username)) {
            $errors .= "使用者名稱不得為空\\n";
        } else if (strlen($username) < 4 || strlen($username) > 20) {
            $errors .= "使用者ID的長度必須至少4個字元且少於20個字元\\n";
        }
        
        if (empty($password)) {
            $errors .= "你的密碼不得為空\\n";
        } else if (strlen($password) < 4 || strlen($password) > 50) {
            $errors .= "密碼的長度必須至少4個字元且少於50個字元\\n";
        }
        
        if (empty($confirmPassword)) {
            $errors .= "再次輸入密碼不得為空\\n";
        } else if ($bPassword != $confirmPassword) {
            $errors .= "你的密碼與再次確認密碼不同，請確保他們是相同的\\n";
        } else if (strlen($confirmPassword) < 4 || strlen($confirmPassword) > 50) {
            $errors .= "確認密碼的長度必須至少4個字元且少於50個字元\\n";
        }

        if(empty($errors)){
            $checkUser = $dbHandler->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $checkUser -> bindParam(':username', $username);
            $checkUser -> execute();

            if($checkUser->fetchColumn() > 0) $errors.= "使用者名稱已經被註冊\\n";

            $checkEmail = $dbHandler->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $checkEmail -> bindParam(':email', $email);
            $checkEmail -> execute();

            if($checkEmail->fetchColumn() > 0) $errors.= "電子郵箱已經被註冊\\n";
        }

        //echo "<script>alert('+$role+'\n'+$userRealName+'\n'+$email+'\n'+$phoneNumber+'\n'+$bloodType+'\n'+$birthday+'\n'+$username +'\n'+ $password+');</script>";
        
        if (!empty($errors)) echo "<script>alert('$errors');</script>";
        else {
            if (!empty($password) && (strlen($password)>=4) && (strlen($password)<=50)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // echo "<script>
                // 		alert('密碼加密');
                // 	</script>";
            }

            try {
                $stmt = $dbHandler->prepare("INSERT INTO users (role, userRealName, email, phoneNumber, bloodType, birthday, username, password) VALUES (:role, :userRealName, :email, :phoneNumber, :bloodType, :birthday, :username, :password)");
                $role = 'user';
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':userRealName', $userRealName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phoneNumber', $phoneNumber);
                $stmt->bindParam(':bloodType', $bloodType);
                $stmt->bindParam(':birthday', $birthday);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();
            
                echo "<script>
                        alert('使用者註冊成功');
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 0);
                    </script>";

            } catch (PDOException $e) {
                echo "資料庫錯誤: " . $e->getMessage();
            }
        }
    }

};