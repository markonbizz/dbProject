<?php

include_once("Misc.php");

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    include_once("Database_EstConnection.php");
    include_once("Misc.php");

    $ERR_REGISTER_MESSAGE = "";

    // Basic
    $bAccount        = $_POST['fAccount']        ?? "";
    $bEmail          = $_POST['fEmail']          ?? "";
    
    // Password
    $bPassword       = $_POST['fPassword']       ?? "";
    $bPasswordAgain  = $_POST['fPassword_Again'] ?? "";
    
    // The infomation probably not that really important
    $bRealName       = $_POST['fRealName']       ?? "";
    $bBirthday       = $_POST['fBirthday']       ?? "";
    $bPhoneNumber    = $_POST['fPhoneNumber']    ?? "";
    

    // ========== Check Account ========== //
    if (empty($bAccount)) {

        $ERR_REGISTER_MESSAGE .= "\"Account\" credential cannot be empty\\n";
    }else if(strlen($bAccount) < 4 || strlen($bAccount) > 32){
    
        $ERR_REGISTER_MESSAGE .= "\"Account\" credential must at least 4 characters and not exceed 32\\n";
    }

    // ========== Check Name ========== //
    if(empty($bRealName)){

        $ERR_REGISTER_MESSAGE .= "\"Name\" credential cannot be empty!\\n";
    }else if(strlen($bRealName) < 2 || strlen($bRealName) > 24) {

        $ERR_REGISTER_MESSAGE .= "\"Name\" credential must at least 2 characters and not exceed 24\\n";
    }

    // ========== Check Email ========== //
    if (empty($bEmail)) {

        $ERR_REGISTER_MESSAGE .= "\"Email\" credential cannot be empty!\\n";
    } else if (strlen($bEmail) < 4 || strlen($bEmail) > 50) {
    
        $ERR_REGISTER_MESSAGE .= "\"Email\" credential must at least 4 characters and not exceed 50\\n";
    }

    // ========== Check PhoneNumber ========== //
    if(empty($bPhoneNumber)){

        $ERR_REGISTER_MESSAGE .= "\"Phone Number\" credential cannot be empty\\n";
    } else if (strlen($bPhoneNumber) != 10){

        $ERR_REGISTER_MESSAGE .= "\"Phone Number\" credential must equal 10 numbers\\n";
    }

    // ========== Check Birthday ========== //
    if(empty($bBirthday)){ //證實生日的格式

        $ERR_REGISTER_MESSAGE .= "\"Birthday\" credential cannot be empty\\n";
    } 
    
    // ========== Check Password ========== //
    if(empty($bPassword)){

        $ERR_REGISTER_MESSAGE .= "\"Password\" credential cannot be empty\\n";
    }else if(strlen($bPassword) < 4 || strlen($bPassword) > 50){

        $ERR_REGISTER_MESSAGE .= "\"Password\" credential must at least 4 characters and not exceed 50\\n";
    }
    
    // ========== Check PasswordAgain ========== //
    if(empty($bPasswordAgain)){

        $ERR_REGISTER_MESSAGE .= "\"This\" credential cannot be empty!\\n";
    }else if ($bPassword != $bPasswordAgain){

        $ERR_REGISTER_MESSAGE .= "\"Password\" is Not Matched\\n";
    }else if(strlen($bPasswordAgain) < 4 || strlen($bPasswordAgain) > 50){

        $ERR_REGISTER_MESSAGE .= "\"Password\" credential must at least 4 characters and not exceed 50\\n";
    }

    // ========== Check If Account is Registered ========== //
    if(empty($errors))
    {
        $checkUser = $dbHandler -> prepare("SELECT COUNT(*) FROM User_Basics WHERE Account = :Account");
        $checkUser-> bindParam(':Account', $bAccount);
        $checkUser-> execute();

        if($checkUser -> fetchColumn() > 0) $ERR_REGISTER_MESSAGE .= "This account has been registered\\n";

        $checkEmail = $dbHandler -> prepare("SELECT COUNT(*) FROM User_Basics WHERE Email = :Email");
        $checkEmail-> bindParam(':Email', $bEmail);
        $checkEmail-> execute();

        if($checkEmail -> fetchColumn() > 0) $ERR_REGISTER_MESSAGE .= "This email has been registered\\n";
    }

/* ==================================================================================================================================================================================== */

    // Write User to Database
    if (!empty($errors)){
    
        echo "<script>alert('$errors');</script>";
    }else{
        
        if(!empty($bPassword) && ((strlen($bPassword)>=4) && (strlen($bPassword)<=50)))
        {  
            $bHashedPassword = password_hash($bPassword, PASSWORD_DEFAULT);
        }

        try{

            $USER_BASICS = 
            "
                INSERT INTO User_Basics ( UserID,  Account,  Email)
                VALUES
                                        (:UserID, :Account, :Email)
            ";

            $USER_PRIVACY = 
            "
                INSERT INTO User_Privacy ( UserID,  RealName,  Birthday,  PhoneNumber)
                VALUES
                                         (:UserID, :RealName, :Birthday, :PhoneNumber)
            ";

            
            $USER_SECURITY = 
            "
                INSERT INTO User_Security ( UserID,  Permission,  Password)
                VALUES
                                          (:UserID, :Permission, :Password)
            ";

            $bUserID = GenerateGUIDv4();
            $bPermission = "USER";
            
            $FLAG_REGISTER_SUCCESS = true;
            // Table: User_Basic
            $SQL_STATMENT = $dbHandler -> prepare($USER_BASICS);
            $SQL_STATMENT-> bindParam(":UserID",    $bUserID);
            $SQL_STATMENT-> bindParam(":Account",   $bAccount);
            $SQL_STATMENT-> bindParam(":Email",     $bEmail);
            $FLAG_REGISTER_SUCCESS &= $SQL_STATMENT-> execute();

            // Table: User_Basic
            $SQL_STATMENT = $dbHandler -> prepare($USER_PRIVACY);
            $SQL_STATMENT-> bindParam(":UserID",        $bUserID);
            $SQL_STATMENT-> bindParam(":RealName",      $bRealName);
            $SQL_STATMENT-> bindParam(":Birthday",      $bBirthday);
            $SQL_STATMENT-> bindParam(":PhoneNumber",   $bPhoneNumber);
            $FLAG_REGISTER_SUCCESS &= $SQL_STATMENT-> execute();

            // Table: User_Basic
            $SQL_STATMENT = $dbHandler -> prepare($USER_SECURITY);
            $SQL_STATMENT-> bindParam(":UserID",        $bUserID);
            $SQL_STATMENT-> bindParam(":Permission",    $bPermission);
            $SQL_STATMENT-> bindParam(":Password",      $bHashedPassword);
            $FLAG_REGISTER_SUCCESS &= $SQL_STATMENT-> execute();

        
            if($FLAG_REGISTER_SUCCESS){
                echo
                "
                    <script>
                        alert(\" Sign Up Successfully ! \");
                        window.location.href = \"index.php\";
                    </script>
                ";
            }

        }catch(PDOException $e){

            echo "Database Error: " . $e->getMessage();
        }
    }
}