<?php

include_once("Database_EstConnection.php");

$PAGINATION_ARGS =
[
    "MAX_RECS_PERPAGE"  => 8,
    "START_POS"         => 0,
    "TOTAL_RECS"        => 0,
    "TOTAL_PAGES"       => 0
];

if(($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET['fRequestSearchOnProductList']) && ($_GET['fRequestSearchOnProductList'])){

    $bSearchHolder = $_GET["fProductListSearchHolder"] ?? "";

    $SEARCH_TABLE =
    "
        SELECT
            C.Name AS CategoryName,
            P.*
        FROM
            `Products` P
        JOIN
            `Categories` C
        ON
            C.CategoryID = P.CategoryID 
        WHERE
            `UploaderID` = :UploaderID
    ";

    if (!empty($bTargetSearchHolder)){ // if search holder is not empty, append the search target.

        $SEARCH_TABLE .=
        "   
            AND
            (
                Name            LIKE :SearchTerm
                OR
                CategoryName    LIKE :SearchTerm
            )
        ";
    }

    {// Limiting Recs on page
        $SEARCH_TABLE .=
        '
            LIMIT
                '. $PAGINATION_ARGS["START_POS"] .', '. $PAGINATION_ARGS["MAX_RECS_PERPAGE"] .'
        ';
    }

    $SQL_STATMENT = $dbHandler -> prepare($SEARCH_TABLE);
    $SQL_STATMENT-> bindParam(":UploaderID", $_SESSION["UserID"]);

    if(!empty($bTargetSearchHolder))
    {
        $SQL_STATMENT-> bindParam(":SearchTerm", $bSearchHolder);
    }
}else{

    $SEARCH_TABLE = 
    "
        SELECT
            C.Name AS CategoryName,
            P.*
        FROM 
            Products P
        JOIN
            Categories C
        ON
            C.CategoryID = P.CategoryID
        WHERE
            P.UploaderID = :UploaderID
        LIMIT
            ". $PAGINATION_ARGS["START_POS"] .", ". $PAGINATION_ARGS["MAX_RECS_PERPAGE"] ."
    ";

    $SQL_STATMENT = $dbHandler -> prepare($SEARCH_TABLE);
    $SQL_STATMENT-> bindParam(":UploaderID", $_SESSION["UserID"]);
}