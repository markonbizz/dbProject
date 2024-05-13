<?php

include_once("User_ProductList_SearchProduct.php");
include_once("Render_User_ProductList_Listing.php");

$PAGINATION_ARGS["TOTAL_RECS"]  = $SQL_STATMENT -> rowCount();
$PAGINATION_ARGS["TOTAL_PAGES"] = ceil($PAGINATION_ARGS["TOTAL_RECS"] / $PAGINATION_ARGS["MAX_RECS_PERPAGE"]);

// =====================================================================
// =========================== First Page =========================== 
// =====================================================================
echo 
"
    <li class=\"page-item\"> <!-- First Page -->
        <a class=\"page-link\" href=\"?CurrentPageIndex=1\" tabindex=\"-1\" aria-disabled=\"false\">First</a>
    </li>
";

// =====================================================================
// =========================== Previous Page =========================== 
// =====================================================================
if(isset($_GET["CurrentPageIndex"]) && ($_GET["CurrentPageIndex"] > 1)){

    $tmp = (int)$_GET["CurrentPageIndex"] - 1;

    echo 
    "
        <li class=\"page-item\"> <!-- Previous Page -->
            <a class=\"page-link\" href=\"?CurrentPageIndex={$tmp}\" tabindex=\"-1\" aria-disabled=\"false\">Previous</a>
        </li>
    ";
}else{

    echo 
    "
        <li class=\"page-item disable\"> <!-- Previous Page -->
            <a class=\"page-link\" tabindex=\"-1\" aria-disabled=\"true\">Previous</a>
        </li>
    ";
}

// =============================================================
// =========================== Pages =========================== 
// =============================================================
for($i = 1; $i <= $PAGINATION_ARGS["TOTAL_PAGES"]; $i++){

    if(isset($_GET["CurrentPageIndex"]) && ($i == (int)$_GET["CurrentPageIndex"])){

        echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"?CurrentPageIndex={$i}\">{$i}</a></li>";
    }else{

        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?CurrentPageIndex={$i}\">{$i}</a></li>";
    }
}


// =================================================================
// =========================== Next Page =========================== 
// =================================================================
if(isset($_GET["CurrentPageIndex"]) && ((int)$_GET["CurrentPageIndex"] < $PAGINATION_ARGS["TOTAL_PAGES"])){

    $tmp = (int)$_GET["CurrentPageIndex"] + 1;

    echo 
    "
        <li class=\"page-item\"> <!-- Previous Page -->
            <a class=\"page-link\" href=\"?CurrentPageIndex={$tmp}\" tabindex=\"-1\" aria-disabled=\"false\">Next</a>
        </li>
    ";
}else{

    echo 
    "
        <li class=\"page-item disable\"> <!-- Previous Page -->
            <a class=\"page-link\" tabindex=\"-1\" aria-disabled=\"true\">Next</a>
        </li>
    ";
}


// =================================================================
// =========================== Last Page =========================== 
// =================================================================
echo
"
    <li class=\"page-item\"> <!-- End Page -->
        <a class=\"page-link\" href=\"?CurrentPageIndex={$PAGINATION_ARGS["TOTAL_PAGES"]}\" tabindex=\"-1\" aria-disabled=\"true\">Last</a>
    </li>
";