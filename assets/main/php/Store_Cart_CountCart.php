<?php

session_start();

include_once("Database_EstConnection.php");

$customerId = $_SESSION["UserID"];

$query = "SELECT COUNT(*) AS TotalProducts FROM Cart WHERE CustomerID = :customerid";
$stmt = $dbHandler->prepare($query);
$stmt->bindParam(':customerid', $customerId, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo $result["TotalProducts"];