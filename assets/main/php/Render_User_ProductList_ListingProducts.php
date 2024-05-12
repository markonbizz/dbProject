<?php

include_once("Database_EstConnection.php");
include_once("User_ProductList_Pagination_Base.php");

if(isset($_GET["CurrentPageIndex"])){

    $CurrentPage = (((int)$_GET["CurrentPageIndex"] - 1) > 0) ? (int)$_GET["CurrentPageIndex"] - 1: 0;
    $DATA_STARTING_IDX = $CurrentPage * MAX_DATA_PERPAGE;
}

$MERGE_TABLES = 
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
        ". $DATA_STARTING_IDX .", ". (MAX_DATA_PERPAGE) ."
";

try{

    $SQL_STATMENT = $dbHandler -> prepare($MERGE_TABLES);
    $SQL_STATMENT-> bindParam(":UploaderID", $_SESSION["UserID"]);

    if($SQL_STATMENT-> execute()){

        if(!$SQL_STATMENT->rowCount()){

            echo 
            "
                <tr>
                    <td class=\"cell\"></td>
                    <td class=\"cell\"></td>
                    <td class=\"cell\">
                        <h6> Nothing but Chickens here :) </h6>
                    </td>
                    <td class=\"cell\"></td>
                    <td class=\"cell\"></td>
                    <td class=\"cell\"></td>
                    <td class=\"cell\"></td>
                </tr>
            ";
        }else{

            while($_ROW_ = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC))
            {
                echo 
                "
                    <tr>
                        <td class=\"cell\">#    {$_ROW_["ProductID"]}       </td>
                        <td class=\"cell\">     {$_ROW_["CategoryName"]}    </td>
                        <td class=\"cell\">     {$_ROW_["Name"]}            </td>
                        <td class=\"cell\">\$   {$_ROW_["Price"]}           </td>
                        <td class=\"cell\">     {$_ROW_["UploadDate"]}      </td>
                        <td class=\"cell\">     {$_ROW_["Description"]}     </td>
                        <td class=\"cell text-end\">
                        
                            <form class=\"fEditForm\" style=\"display: inline-block;\" action=\"UserProductList.php\" method=\"post\">
                                <input name=\"fEditTargetProduct\" value=\"{$_ROW_["ProductID"]}\" type=\"hidden\">
                                <button name=\"fRequestEditProduct\" value=\"true\" class=\"btn app-btn-primary\">Edit</button>
                            </form>

                            &nbsp;

                            <form class=\"fRemoveForm\" style=\"display: inline-block;\" action=\"UserProductList.php\" method=\"post\">
                                <input name=\"fRemoveTargetProduct\" value=\"{$_ROW_["ProductID"]}\" type=\"hidden\">
                                <button name=\"fRequestRemoveProduct\" value=\"true\" class=\"btn app-btn-danger\">Remove</button>
                            </form>

                        </td>
                    </tr>
                ";
            }
        }
    }
}catch(PDOException $ERR){

    echo "Database Error: " . $ERR -> getMessage();
}

