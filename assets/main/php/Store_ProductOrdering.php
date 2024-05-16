<?php

include_once("Database_EstConnection.php");
include_once("Session_CheckAuth.php");


if(isset($_GET["fRequestAddToCart"]) && isset($_GET["fRequestedProductID"]) && $_GET["fRequestAddToCart"] && $_GET["fRequestedProductID"]){

    Session_CheckAuthLevel(checkAuth: "USER", active: true);



    $checkCartExists = $dbHandler -> prepare("SELECT COUNT(*) FROM Cart WHERE (ProductID = :ProductID AND CustomerID = :CustomerID)");
    $checkCartExists-> bindParam(':ProductID',  $_GET['fRequestedProductID'],   PDO::PARAM_STR);
    $checkCartExists-> bindParam(':CustomerID', $_SESSION['UserID'],            PDO::PARAM_STR);
    $checkCartExists-> execute();

}