<?php
/* Go to Edit Page */
if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['fRequestEditProduct']) && ($_POST['fRequestEditProduct'])) {

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

    if ($SQL_STATMENT -> rowCount() > 0) {

        $_SESSION["ProductID"] = $_POST['fEditTargetProduct'];
        echo '<script>window.location.href = "UserEditProduct.php";</script>';
        exit;
    } else {
       
        echo "<script>alert('Target not found, redirecting to product list page!');</script>";
        echo '<script>window.location.href= "UserProductList.php";</script>';
    }
}

/* Remove */
if(($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['fRequestRemoveProduct']) && ($_POST['fRequestRemoveProduct'])){

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