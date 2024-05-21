<?php

function EmptyCart(){

    include_once("Database_EstConnection.php");

    $EMPTY_CART_ITEMS = "

        DELETE FROM Cart WHERE CustomerID = :CustomerID
    ";

    $CLEARALL_STMT = $dbHandler -> prepare($EMPTY_CART_ITEMS);
    $CLEARALL_STMT-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);

    return ($CLEARALL_STMT-> execute()) ? true: false;
}

session_start();

if(EmptyCart()){

    session_unset();
    session_destroy();
}