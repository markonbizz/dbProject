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
            exit("CSRF token validation failed");
        }

        $userRealName    = $_POST['userRealName']    ?? "";
        $email           = $_POST['email']           ?? "";
        $phoneNumber     = $_POST['phoneNumber']     ?? "";
        $bloodType       = $_POST['bloodType']       ?? "";
        $birthday        = $_POST['birthday']        ?? "";
        $username        = $_POST['username']        ?? "";
        $password        = $_POST['password']        ?? "";
        $confirmPassword = $_POST['confirmPassword'] ?? "";
        
        $errors = '';
        if (empty($userRealName)) {
            $errors .= "使用者姓名不得為空\\n";
        } else if (strlen($userRealName) < 2 || strlen($userRealName) > 20) {
            $errors .= "使用者姓名的長度必須至少2個字元且少於20個字元\\n";
        }
        
        if (empty($email)) {
            $errors .= "電子郵箱不得為空\\n";
        } else if (strlen($email) < 4 || strlen($email) > 50) {
            $errors .= "電子郵箱的長度必須至少4個字元且少於50個字元\\n";
        }

        if (empty($phoneNumber)) {
            $errors .= "手機號碼不得為空\\n";
        } else if (strlen($phoneNumber) != 10) {
            $errors .= "手機號碼的長度必須等於10個字元\\n";
        }

        if ($bloodType == "你的血型")
            $errors .= "未選擇血型，請選擇血型\\n";

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
        } else if ($password != $confirmPassword) {
            $errors .= "你的密碼與再次確認密碼不同，請確保他們是相同的\\n";
        } else if (strlen($confirmPassword) < 4 || strlen($confirmPassword) > 50) {
            $errors .= "確認密碼的長度必須至少4個字元且少於50個字元\\n";
        }

        if(empty($errors)){
            $checkUser = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $checkUser -> bindParam(':username', $username);
            $checkUser -> execute();

            if($checkUser->fetchColumn() > 0) $errors.= "使用者名稱已經被註冊\\n";

            $checkEmail = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
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
                $stmt = $db->prepare("INSERT INTO users (role, userRealName, email, phoneNumber, bloodType, birthday, username, password) VALUES (:role, :userRealName, :email, :phoneNumber, :bloodType, :birthday, :username, :password)");
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