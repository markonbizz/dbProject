<?php
/* Go to View Page */
if(($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['fRequestViewUser']) && ($_POST['fRequestViewUser'])){

    $bTargetUserID = $_POST['fFetchTargetUser'] ?? "";

    if(!(empty($bTargetUserID)) && ($bTargetUserID)){

        echo "
            <script>
                window.location.href = \"AdminUserInDetails.php?fFetchTargetUser={$bTargetUserID}&fRequestViewUser=true\";
            </script>
        ";
    }
}


/* Remove */
if(($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['fRequestRemoveUser']) && ($_POST['fRequestRemoveUser'])){

    include_once("Database_EstConnection.php");

    $bTargetUserID = $_POST['fRemoveTargetUser'];

    $REMOVE_FROM_USER_BASICS = 
    "
        DELETE FROM `User_Basics`
        WHERE
            UserID = :UserID
    ";

    $REMOVE_FROM_USER_PRIVACY = 
    "
        DELETE FROM `User_Privacy`
        WHERE
            UserID = :UserID
    ";

    $REMOVE_FROM_USER_SECURITY = 
    "
        DELETE FROM `User_Security`
        WHERE
            UserID = :UserID
    ";

    $REMOVE_FROM_ORDERS = 
    "
        DELETE FROM `Orders`
        WHERE
            CustomerID = :CustomerID
    ";

    $REMOVE_FROM_CART = 
    "
        DELETE FROM Cart
        WHERE
            CustomerID = :CustomerID
    ";

    $REMOVE_FROM_PRODUCTS = 
    "
        DELETE FROM Products
        WHERE
            UploaderID = :UploaderID
    ";

    $RM_FROM_UBAS_STMT = $dbHandler -> prepare($REMOVE_FROM_USER_BASICS);
    $RM_FROM_UPVC_STMT = $dbHandler -> prepare($REMOVE_FROM_USER_PRIVACY);
    $RM_FROM_USEC_STMT = $dbHandler -> prepare($REMOVE_FROM_USER_SECURITY);
    
    $RM_FROM_ORDS_STMT = $dbHandler -> prepare($REMOVE_FROM_ORDERS);
    $RM_FROM_CART_STMT = $dbHandler -> prepare($REMOVE_FROM_CART);
    $RM_FROM_PDTS_STMT = $dbHandler -> prepare($REMOVE_FROM_PRODUCTS);
    
    $RM_FROM_UBAS_STMT-> bindParam(":UserID",       $bTargetUserID, PDO::PARAM_STR);
    $RM_FROM_UPVC_STMT-> bindParam(":UserID",       $bTargetUserID, PDO::PARAM_STR);
    $RM_FROM_USEC_STMT-> bindParam(":UserID",       $bTargetUserID, PDO::PARAM_STR);

    $RM_FROM_ORDS_STMT-> bindParam(":CustomerID",   $bTargetUserID, PDO::PARAM_STR);
    $RM_FROM_CART_STMT-> bindParam(":CustomerID",   $bTargetUserID, PDO::PARAM_STR);
    $RM_FROM_PDTS_STMT-> bindParam(":UploaderID",   $bTargetUserID, PDO::PARAM_STR);


    if
    (
        $RM_FROM_UBAS_STMT -> execute() && 
        $RM_FROM_UBAS_STMT -> execute() &&
        $RM_FROM_USEC_STMT -> execute() &&
        $RM_FROM_ORDS_STMT -> execute() &&
        $RM_FROM_CART_STMT -> execute() &&
        $RM_FROM_PDTS_STMT -> execute()
    ){

        echo 
        '
            <script>
                alert("The user & its Relevance are successfully deleted.")
                window.location.href = AdminUserList.php;
            </>
        ';
    }else{

        echo 
        '
            <script>
                alert("Failed to delete the User & some of its Relevance.")
            </script>
        ';
    }
    
}