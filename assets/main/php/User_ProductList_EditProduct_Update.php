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


if (($_SERVER["REQUEST_METHOD"] === "POST") && ($_POST["fUpdateProduct"])) {

    include_once("Database_EstConnection.php");

    $bUpdateProductImage          = $_FILES['fProductImage'];
    $bUpdateProductName           = $_POST['fProductName'];

/* ========================================================================================================= */

    if($_POST['fProductCategory'] == '0'){
    
        $bUpdateProductCategory   = $_POST["fProductCustomCategory"];
        
    }else{

        $bUpdateProductCategory   = $_POST['fProductCategory'];
    }

/* ========================================================================================================= */

    $bUpdateProductPrice          = $_POST['fProductPrice'];
    $bUpdateProductDescription    = $_POST['fProductDescription'];
    $bUpdateProductUploadDate     = date('Y-m-d H:i:s');

/* ========================================================================================================= */
/* ========================================================================================================= */


    if (empty($bUpdateProductName) || empty($bUpdateProductPrice) || $bUpdateProductImage['error'] !== UPLOAD_ERR_OK){

        echo "<script>alert('All the credentials have to be formated, include the picture');</script>";
    } else {

        $check = getimagesize($bUpdateProductImage["tmp_name"]);
        
        if ($check !== false) {

            $imageContent = file_get_contents($bUpdateProductImage["tmp_name"]); 

            if ($imageContent !== false){

                $UPDATE_PRODUCT =
                '
                    UPDATE 
                        `Products`
                    SET 
                        `CategoryID`    = :CategoryID,
                        `Image`         = :Image,
                        `Name`          = :Name,
                        `Price`         = :Price,
                        `Description`   = :Description,
                        `UploadDate`    = :UploadDate
                    WHERE
                        (
                            `ProductID`     = :ProductID
                            AND
                            `UploaderID`    = :UploaderID
                        )
                ';

                $SQL_STATMENT = $dbHandler->prepare($UPDATE_PRODUCT);
                
                if($_POST['fProductCategory'] == '0'){

                    InsertNewCategory($bUpdateProductCategory);
                    $TGT_CategoryID = GetCategoryID($bUpdateProductCategory);
                    $SQL_STATMENT-> bindParam(":CategoryID", $TGT_CategoryID);
                }else{

                    $SQL_STATMENT-> bindParam(":CategoryID", $bUpdateProductCategory);
                }

                $SQL_STATMENT-> bindParam(':ProductID',     $_SESSION["ProductID"]);
                $SQL_STATMENT-> bindParam(':UploaderID',    $_SESSION['UserID']);
                
                $SQL_STATMENT-> bindParam(':Image',         $imageContent, PDO::PARAM_LOB);
                $SQL_STATMENT-> bindParam(':Name',          $bUpdateProductName);
                $SQL_STATMENT-> bindParam(':Price',         $bUpdateProductPrice);
                $SQL_STATMENT-> bindParam(':Description',   $bUpdateProductDescription);
                $SQL_STATMENT-> bindParam(':UploadDate',    $bUpdateProductUploadDate);

                if ($SQL_STATMENT->execute()){

                    echo 
                    "
                        <script>
                            alert('Product updated successfully');
                        </script>
                    ";
                    unset($_SESSION["ProductID"]);
                    echo
                    "   
                        <script>
                            window.location.href = \"UserProductList.php\";
                        </script>
                    ";
                } else {

                    echo "<script>alert('Failed to updated product: " . $SQL_STATMENT->errorInfo()[2] . "');</script>";
                }
            } else {

                echo "<script>alert('Failed to load the picture');</script>";
            }
        } else {

            echo "<script>alert('Invaild image format');</script>";
        }
    }
}