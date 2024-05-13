<?php

include_once("User_ProductList_SearchProduct.php");

if(isset($_GET["CurrentPageIndex"]) && ($_GET["CurrentPageIndex"])){

    $CurrentPage = (((int)$_GET["CurrentPageIndex"] - 1) > 0) ? (int)$_GET["CurrentPageIndex"] - 1: 0;

    $PAGINATION_ARGS["START_POS"] = $CurrentPage * $PAGINATION_ARGS["MAX_RECS_PERPAGE"];
}

if($SQL_STATMENT -> execute()){

    if(!($SQL_STATMENT -> rowCount())){

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
        
        while($_RECS_ = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC)){

            echo 
            "
                <tr>
                    <td class=\"cell\">#    {$_RECS_["ProductID"]}       </td>
                    <td class=\"cell\">     {$_RECS_["CategoryName"]}    </td>
                    <td class=\"cell\">     {$_RECS_["Name"]}            </td>
                    <td class=\"cell\">\$   {$_RECS_["Price"]}           </td>
                    <td class=\"cell\">     {$_RECS_["UploadDate"]}      </td>
                    <td class=\"cell\">     {$_RECS_["Description"]}     </td>
                    <td class=\"cell text-end\">
                    
                        <form class=\"fEditForm\" style=\"display: inline-block;\" action=\"UserProductList.php\" method=\"post\">
                            <input name=\"fEditTargetProduct\" value=\"{$_RECS_["ProductID"]}\" type=\"hidden\">
                            <button name=\"fRequestEditProduct\" value=\"true\" class=\"btn app-btn-primary\">Edit</button>
                        </form>

                        &nbsp;

                        <form class=\"fRemoveForm\" style=\"display: inline-block;\" action=\"UserProductList.php\" method=\"post\">
                            <input name=\"fRemoveTargetProduct\" value=\"{$_RECS_["ProductID"]}\" type=\"hidden\">
                            <button name=\"fRequestRemoveProduct\" value=\"true\" class=\"btn app-btn-danger\">Remove</button>
                        </form>

                    </td>
                </tr>
            ";
        }
    }
}