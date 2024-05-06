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

            $_SESSION['UID']         = $bTargetUser['UID']; 
            $_SESSION['Account']    = $bTargetUser['Account']; 
            $_SESSION['Email']      = $bTargetUser['Email']; 
            $_SESSION['Permission'] = $bTargetUser['Permission'];

            if($_SESSION['Permission'] == "ADMIN"){
                    
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
                        alert(\" Login Successfully ! \");
                        window.location.href = \"index.php\";
                    </script>
                "; 
            }

            exit();
        } else {
            // 登入失敗以及錯誤訊息
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