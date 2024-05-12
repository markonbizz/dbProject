<?php

if (($_SERVER['REQUEST_METHOD'] === "POST") && ($_POST['fEditThisProduct'])) {

    include_once("Database_EstConnection.php");

    $SQL_STATMENT = $dbHandler->prepare("SELECT * FROM Products WHERE ProductID = :ProductID AND UploaderID = :UploaderID");
    $SQL_STATMENT->bindParam(':ProductID', $_POST['fEditTargetProduct']);
    $SQL_STATMENT->bindParam(':UploaderID', $_SESSION['UserID']);
    $SQL_STATMENT->execute();
    $bEditTargetProduct = $_POST['fEditTargetProduct'];

    if ($SQL_STATMENT->rowCount() > 0) {
        
        echo '<script>window.location.href = "UserEditProduct.php?ProductID=' . $_POST['fEditTargetProduct'] . '";</script>';
        exit;
    } else {
       
        echo "<script>alert('Unauthorized Access !');</script>";
        echo '<script>window.location.href= "UserProductList.php";</script>';
    }
}