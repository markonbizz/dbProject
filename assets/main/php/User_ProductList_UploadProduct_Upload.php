<?php

function InsertNewCategory(string $Name){

    include("Database_EstConnection.php");

    $NEW_CATEGORY = 
    "
        INSERT INTO Categories
        (`Name`) VALUES (:Name)
    ";

    $SQL_STATMENT = $dbHandler -> prepare($NEW_CATEGORY);
    $SQL_STATMENT-> bindParam(":Name", $Name);

    try{

        if($SQL_STATMENT-> execute()){

            return true;
        }else{

            return false;
        }
    }catch(PDOException $ERR){
    
        echo "Database error: " . $ERR->getMessage();

        return false;
    }
}

function GetCategoryID(string $Name){
    
    include("Database_EstConnection.php");
    
    $TGT_CATEGORY = 
    "
        SELECT CategoryID FROM Categories WHERE Name = :Name
    ";

    $SQL_STATMENT = $dbHandler -> prepare($TGT_CATEGORY);
    $SQL_STATMENT-> bindParam(":Name", $Name);
    $SQL_STATMENT-> execute();

    $target = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

    return $target["CategoryID"];
}



/* ================================================================================================================================================================================================================== */
/* ================================================================================================================================================================================================================== */



if (($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fUploadProduct"]) && ($_POST["fUploadProduct"])) {

    include_once("Database_EstConnection.php");
    
    $bProductImage          = $_FILES['fProductImage'];
    $bProductName           = $_POST['fProductName'];

/* ========================================================================================================= */

    $bProductCategory       = $_POST['fProductCategory'];

/* ========================================================================================================= */

    $bProductPrice          = $_POST['fProductPrice'];
    $bProductDescription    = $_POST['fProductDescription'];
    $bProductUploadDate     = date('Y-m-d H:i:s');

/* ========================================================================================================= */
/* ========================================================================================================= */


    if (empty($bProductName) || empty($bProductPrice) || $bProductImage['error'] !== UPLOAD_ERR_OK){

        echo "<script>alert('All the credentials have to be formated, include product picture');</script>";
    } else {

        $FILE_CHECKER = getimagesize($bProductImage["tmp_name"]);
        
        if ($FILE_CHECKER !== false) {

            $uploadStatus = (file_exists("images/" . $bUpdateProductImage["name"])) ? true: 
                            move_uploaded_file($bUpdateProductImage["tmp_name"], ("images/" . $bUpdateProductImage["name"]));

            if ($uploadStatus !== false){

                $UPLOAD_PRODUCT =
                "
                    INSERT INTO Products
                    (`CategoryID`, `UploaderID`, `Image`, `Name`, `Price`, `Description`, `UploadDate`)
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?)
                ";

                $SQL_STATMENT = $dbHandler->prepare($UPLOAD_PRODUCT);
            
                $SQL_STATMENT-> bindParam(1, $bProductCategory);
                $SQL_STATMENT-> bindParam(2, $_SESSION['UserID']);
                $SQL_STATMENT-> bindParam(3, $bProductImage["name"], PDO::PARAM_STR);
                $SQL_STATMENT-> bindParam(4, $bProductName);
                $SQL_STATMENT-> bindParam(5, $bProductPrice);
                $SQL_STATMENT-> bindParam(6, $bProductDescription);
                $SQL_STATMENT-> bindParam(7, $bProductUploadDate);

                if ($SQL_STATMENT->execute()){

                    echo 
                    "
                        <script>
                            alert('Product uploaded successfully');
                            window.location.href = \"UserUploadProduct.php\";
                        </script>
                    ";
                } else {

                    echo "<script>alert('Failed to upload product: " . $SQL_STATMENT->errorInfo()[2] . "');</script>";
                }
            } else {

                echo "<script>alert('Failed to load the picture');</script>";
            }
        } else {

            echo "<script>alert('Invaild image format');</script>";
        }
    }
}