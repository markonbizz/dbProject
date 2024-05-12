<?php

if (($_SERVER['REQUEST_METHOD'] === "POST") && ($_POST['fRequestEditProduct'])) {

    include_once("Database_EstConnection.php");

    $TARGET_PRODUCT = 
    "
        SELECT * 
        FROM 
            `Products`
        WHERE 
            `ProductID` = :ProductID 
        AND 
            `UploaderID` = :UploaderID
    ";

    $SQL_STATMENT = $dbHandler -> prepare($TARGET_PRODUCT);
    $SQL_STATMENT-> bindParam(':ProductID',     $_POST['fEditTargetProduct']);
    $SQL_STATMENT-> bindParam(':UploaderID',    $_SESSION['UserID']);
    $SQL_STATMENT-> execute();
    $bEditTargetProduct = $_POST['fEditTargetProduct'];

    if ($SQL_STATMENT -> rowCount() > 0) {
        
        echo '<script>window.location.href = "UserEditProduct.php?ProductID=' . $_POST['fEditTargetProduct'] . '";</script>';
        exit;
    } else {
       
        echo "<script>alert('Unauthorized Access, redirecting to product list page!');</script>";
        echo '<script>window.location.href= "UserProductList.php";</script>';
    }
}