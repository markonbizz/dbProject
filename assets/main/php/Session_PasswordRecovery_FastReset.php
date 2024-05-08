<?php

if($_SESSION["bAccount"]){

    include_once("Database_EstConnection.php");

    $bHashedPassword = password_hash($_SESSION["bAccount"], PASSWORD_DEFAULT);

    $stmt = $dbHandler->prepare("UPDATE Users SET Password=:Password WHERE Account=:Account");
    $stmt->bindParam(':Account', $_SESSION["bAccount"]);
    $stmt->bindParam(':Password', $bHashedPassword);
    $stmt->execute();

    echo
    "
        <script>
            alert(\" Reset Successfully \");
            alert(\" Warning: Fast Mode is used, please switch to Normal Mode \");
            window.location.href = \"Login.php\";
        </script>
    ";
}