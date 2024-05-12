<?php

include_once("Database_EstConnection.php");

define("MAX_PRODUCTS_PERPAGE", 8);

$MERGE_TABLES = 
"
    SELECT 
        C.Name AS CategoryName, 
        P.*
    FROM 
        `Products` P
    INNER JOIN
        `Categories` C
    ON
        C.CategoryID = P.CategoryID
";

try{

    $SQL_STATMENT = $dbHandler -> prepare($MERGE_TABLES);
    $SQL_STATMENT-> execute();
    while($_ROW_ = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC))
    {
        echo 
        "
            <tr>
                <td class=\"cell\">#".  $_ROW_["ProductID"]     ."</td>
                <td class=\"cell\">".   $_ROW_["CategoryName"]  ."</td>
                <td class=\"cell\">".   $_ROW_["Name"]          ."</td>
                <td class=\"cell\">$".  $_ROW_["Price"]         ."</td>
                <td class=\"cell\">".   $_ROW_["UploadDate"]    ."</td>
                <td class=\"cell text-end\">
                    <form class=\"fEditForm\" style=\"display: inline-block;\">
                        <input name=\"fEditTargetProduct\" class=\"\" value=\"\" type=\"hidden\">
                        <button name=\"fEditProduct\" class=\"btn app-btn-primary\">Edit</button>
                    </form>
                    &nbsp;
                    <form class=\"fRemoveForm\" style=\"display: inline-block;\">
                        <input name=\"fRemoveTargetProduct\" class=\"\" value=\"\" type=\"hidden\">
                        <button name=\"fRemoveProduct\" class=\"btn app-btn-danger\">Edit</button>
                    </form>
                </td>
            </tr>
        ";
    }
}catch(PDOException $ERR){

    echo "Database Error: " . $ERR -> getMessage();
}