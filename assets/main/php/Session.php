<?php

include_once("Database.php");
include_once("Misc.php");

class Session{

    public function Login()
    {
        $dbHandler = new Database();

        // Fetch Database's Infomation
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {

            $targetDB = $dbHandler -> EstConnectionTo("DEArmory", "root", "#u2324");

            $bAccount  = $_POST['fAccount']  ?? '';
            $bPassword = $_POST['fPassword'] ?? '';

            // Look up the user in login credential.
            $SQL_Statment = $targetDB -> prepare("SELECT * FROM Users WHERE Account = :Account");
            $SQL_Statment -> bindParam(':Account', $bAccount);
            $SQL_Statment -> execute();

            $targetUser = $SQL_Statment -> fetch(PDO::FETCH_ASSOC);
        }

        // Verify & Login
        if(($targetUser) && password_verify($bPassword, $targetUser["Password"]))
        {
            /*
                Using "$_SESSION" to store user infomation to "Make Sure" the user is existed.
                
                Furthermore, "$_SESSION" is a "Pre Defined" global variable, which its scope is
                "System-Wide". 
            */

            $_SESSION["Account"]    = $targetUser["Account"];
            $_SESSION["Email"]      = $targetUser["Email"];
            $_SESSION["Permission"] = $targetUser["Permission"];

            if(isset($_SESSION["Account"]) && !empty($_SESSION["Account"])){

                echo 
                "
                    <script>
                        alert(\" Login Successfully ! \");
                        window.location.href = \"index.php\";
                    </script>
                ";
            }else{

                echo 
                "
                    <script>
                        alert(\" Login Failed: Invalid User or Password \");
                        window.location.href = \"Login.php\";
                    </script>
                "; 
            }            
        }
    }

    public function Register()
    {
        $dbHandler   = new Database();
        $miscHandler = new Misc();

        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $targetDB = $dbHandler -> EstConnectionTo("DEArmory", "root", "#u2324");
            
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
                $checkUser = $targetDB -> prepare("SELECT COUNT(*) FROM Users WHERE Account = :Account");
                $checkUser -> bindParam(':Account', $bAccount);
                $checkUser -> execute();

                if($checkUser->fetchColumn() > 0) $ERR_REGISTER_MESSAGE .= "This account has been registered\\n";

                $checkEmail = $targetDB -> prepare("SELECT COUNT(*) FROM Users WHERE Email = :Email");
                $checkEmail -> bindParam(':Email', $bEmail);
                $checkEmail -> execute();

                if($checkEmail -> fetchColumn() > 0) $ERR_REGISTER_MESSAGE .= "This email has been registered\\n";
            }


            // Write User to Database
            if (!empty($errors)){
            
                echo "<script>alert('$errors');</script>";
            }else{
                
                if(!empty($bPassword) && ((strlen($bPassword)>=4) && (strlen($bPassword)<=50)))
                {  
                    $bHashedPassword = password_hash($bPassword, PASSWORD_DEFAULT);
                }

                try {
                    $stmt = $targetDB->prepare("INSERT INTO 
                                                Users (UID, Permission, RealName, Email, PhoneNumber, Birthday, Account, Password) 
                                                        VALUES 
                                                      (:UID, :Permission, :RealName, :Email, :PhoneNumber, :Birthday, :Account, :Password)");
                    
                    $bUserID     = $miscHandler -> GenerateUniqueSEQ(length: 8);
                    $bPermission = 'USER';

                    // ========== Permission ==========
                    $stmt->bindParam(':UID'         , $bUserID);
                    $stmt->bindParam(':Permission'  , $bPermission);

                    // ========== Basic ==========
                    $stmt->bindParam(':Account'     , $bAccount);
                    $stmt->bindParam(':Email'       , $bEmail);

                    // ========== Password ==========
                    $stmt->bindParam(':Password'    , $bHashedPassword);

                    // ========== Again, the infomation probably not that really important ==========
                    $stmt->bindParam(':RealName'    , $bRealName);
                    $stmt->bindParam(':Birthday'    , $bBirthday);
                    $stmt->bindParam(':PhoneNumber' , $bPhoneNumber);

                    $FLAG_REGISTER_SUCCESS = $stmt->execute();
                
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
    }
};