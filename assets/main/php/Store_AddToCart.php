<?php

if(session_status()){
    session_start();
}

include_once("Database_EstConnection.php");
include_once("Session_CheckAuth.php");

if(Session_CheckAuthLevel("USER", "../../../Login.php") && ($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fRequestAddToCart"]) && ($_POST["fRequestAddToCart"])){

    if(isset($_POST["fAddProductID"]) && ($_POST["fAddProductID"]) && isset($_POST["fAddProductQuantity"]) && ($_POST["fAddProductQuantity"])){
    
        $CHECK_IF_PRODUCT_IS_INCART = "

            SELECT COUNT(1) FROM Cart WHERE ProductID = :ProductID LIMIT 1
        ";

        $bTargetProduct = $_POST["fAddProductID"];
        $CHECKER_STMT = $dbHandler -> prepare($CHECK_IF_PRODUCT_IS_INCART);
        $CHECKER_STMT-> bindParam(":ProductID", $bTargetProduct, PDO::PARAM_INT);
        $CHECKER_STMT-> execute();

        if($CHECKER_STMT-> fetchColumn() == 0){

            $INSERT_TO_CART = "
                INSERT INTO Cart ( CustomerID,  ProductID,  Quantity,  PayAmount) 
                                    VALUES
                                    (:CustomerID, :ProductID, :Quantity, :PayAmount)
            ";

            $bCustomerID        = $_SESSION["UserID"]           ?? "";
            $bProductID         = $_POST["fAddProductID"]       ?? "";
            $bProductQuantity   = $_POST["fAddProductQuantity"] ?? 1;
            $bProductPrice      = $_POST["fAddProductPrice"]    ?? "";
            
            $bProductPayAmount  = $bProductPrice * $bProductQuantity;

            $ADDCART_STMT = $dbHandler -> prepare($INSERT_TO_CART);
            $ADDCART_STMT-> bindParam(":CustomerID",  $bCustomerID,         PDO::PARAM_STR);
            $ADDCART_STMT-> bindParam(":ProductID",   $bProductID,          PDO::PARAM_INT);
            $ADDCART_STMT-> bindParam(":Quantity",    $bProductQuantity,    PDO::PARAM_INT);
            $ADDCART_STMT-> bindParam(":PayAmount",   $bProductPayAmount,   PDO::PARAM_INT);

            try{
            
                if($ADDCART_STMT -> execute()){

                    echo
                    "
                        <script>
                            alert(\"Product Successfullt Added.\");
                            window.location.href = \"../../../Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
                        </script>
                    ";
                }

            }catch(PDOException $ERR){
            
                echo "DATABASE ERROR:" . $ERR -> getMessage();
            }
        }else{

            echo"

                <script>
                    alert(\"The Product is already in the shopping cart.\");
                    window.location.href = \"../../../Shop.php?fShopSearchHolder=&fRequestShopSearch=true\"
                </script>                                       
            ";
        }

    }
}