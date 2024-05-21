<?php

session_start();

include_once("Database_EstConnection.php");

$sql = "SELECT * FROM Cart WHERE CustomerID = :CustomerID";
$result = $dbHandler -> prepare($sql);
$result-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);

$total = 0;
if ($result -> execute()) {
    // Calculate total
    while($row = $result -> fetch(PDO::FETCH_ASSOC)) {
        $total += $row["PayAmount"];
    }
}

echo $total;