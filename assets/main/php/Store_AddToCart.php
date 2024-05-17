<?php

include_once("Database_EstConnection.php");
include_once("Session_CheckAuth.php");


if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fRequestAddToCart"]) && ($_POST["fRequestAddToCart"])){

    Session_CheckAuthLevel(checkAuth: "USER", active: true);

    if(isset($_POST["fAddProductID"]) && ($_POST["fAddProductID"]) && isset($_POST["fAddProductQuantity"]) && ($_POST["fAddProductQuantity"])){

        $INSERT_TO_CART = "
            INSERT INTO Cart ( ProductID,  Quantity,  CustomerID) 
                             VALUES
                             (:ProductID, :Quantity, :CustomerID)
        ";

        $bProductID         = $_POST["fAddProductID"]       ?? "";
        $bProductQuantity   = $_POST["fAddProductQuantity"] ?? 1;
        $bCustomerID        = $_SESSION["UserID"]           ?? "";

        $ADDCART_STMT = $dbHandler -> prepare($INSERT_TO_CART);
        $ADDCART_STMT-> bindParam(":ProductID",     $bProductID,        PDO::PARAM_INT);
        $ADDCART_STMT-> bindParam(":Quantity",      $bProductQuantity,  PDO::PARAM_INT);
        $ADDCART_STMT-> bindParam(":CustomerID",    $bCustomerID,       PDO::PARAM_STR);


        try{
        
            if($ADDCART_STMT -> execute()){

                echo
                "
                    <script>
                        alert(\"Product Successfullt Added.\");
                        window.location.href = \"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
                    </script>
                ";
            }

        }catch(PDOException $ERR){
        
            echo "DATABASE ERROR:" . $ERR -> getMessage();
        }
    }
}