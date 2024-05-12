<?php

if(($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['fRequestRemoveProduct'])){

    include_once("Database_EstConnection.php");

    $bTargetProductID = $_POST['fRemoveTargetProduct'];

    $REMOVE_TGT_PRODUCT = 
    "
        DELETE FROM Products
        WHERE
            ProductID = :ProductID
                AND
            UploaderID = :UploaderID
    ";

    $SQL_STATMENT = $dbHandler -> prepare($REMOVE_TGT_PRODUCT);
    $SQL_STATMENT-> bindParam(":ProductID", $bTargetProductID);
    $SQL_STATMENT-> bindParam(":UploaderID", $_SESSION["UserID"]);


    if($SQL_STATMENT->execute()){

        echo 
        '
            <script>
                alert("Product is successfully deleted.")
                window.location.href = UserProductList.php;
            </script>
        ';
    }else{

        echo 
        '
            <script>
                alert("Failed to delete the product.")
            </script>
        ';
    }
    
}