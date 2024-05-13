<?php

if($_SESSION["ProductID"]){
										
    include_once("Database_EstConnection.php");

    $TGT_PRODUCT = $_SESSION["ProductID"];

    $MERGE_TABLES = 
    "
        SELECT

            C.Name AS CategoryName,
            P.*
        FROM 
            Products P
        JOIN
            Categories C
        ON
            C.CategoryID = P.CategoryID
        WHERE
            (
                P.UploaderID = :UploaderID
                AND
                P.ProductID = :ProductID
            )
    ";

    $SQL_STATMENT = $dbHandler->prepare($MERGE_TABLES);
    $SQL_STATMENT-> bindParam(":UploaderID", $_SESSION["UserID"]);
    $SQL_STATMENT-> bindParam(":ProductID", $_SESSION["ProductID"]);
    
    try{

        $SQL_STATMENT-> execute();
        $targetProduct = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

        if($targetProduct){
        
            echo
            "
                <h6 style='display: inline-block;'>Image:</h6>
                    
                    <img src='data:image/jpeg;base64,".base64_encode($targetProduct['Image'])."' alt='Product Image' style='max-width: 45%; max-height: 45%;'>
                    
                <hr class='my-4'>
                <h6>Product:&nbsp;        {$targetProduct["Name"]}</h6>
                <h6>Category:&nbsp;       {$targetProduct["CategoryName"]}</h6>
                <h6>Price:&nbsp;        \${$targetProduct["Price"]}</h6>
                <h6>Description:&nbsp;    {$targetProduct["Description"]} </h6>
                <h6>Upload Date:&nbsp;    {$targetProduct["UploadDate"]}</h6>
            ";
        }else{

            echo "No infomation on this product.";
        }
    }catch(PDOException $ERR){
    
        echo "Database" . $ERR -> getMessage();
    }
}