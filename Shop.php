<?php

    session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DENNIS' ARMORY | Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/main/css/bootstrap.min.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/font-awesome.min.css"  type="text/css">
    <link rel="stylesheet" href="assets/main/css/elegant-icons.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/nice-select.css"       type="text/css">
    <link rel="stylesheet" href="assets/main/css/jquery-ui.min.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/owl.carousel.min.css"  type="text/css">
    <link rel="stylesheet" href="assets/main/css/slicknav.min.css"      type="text/css">
    <link rel="stylesheet" href="assets/main/css/style.css"             type="text/css">

    <!-- CSS Override -->
    <link rel="stylesheet" href="assets/main/css/custom_style.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="assets/main/images/logo-title.svg" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>dennisbrown12345@email.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">

                            <?php

                                include_once(_UTILITIES_PATH_ . "Render_Store_Topbar_LoginWelcome.php");
                            
                            ?>
                        
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            
                            <?php

                                include_once(_UTILITIES_PATH_ . "Render_Store_Topbar_AccountEntry.php");
                                echo "&nbsp";
                                echo "&nbsp";
                                if(isset($_SESSION["Account"])){

                                    echo
                                    "
                                        <div class=\"header__top__right__auth\">
                                            <a id=\"RequestUserLogout\">
                                                <i class=\"fa fa-sign-out\"></i>
                                                <strong> Logout </strong>
                                            </a>
                                        </div>
                                    ";
                                }
                            ?>

                            <!-- SweetAlert2 Logout Prompts -->
                            <?php

                                echo "
                                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                    <script>

                                        document.addEventListener('DOMContentLoaded', function() {

                                            const RequestUserLogout = document.getElementById('RequestUserLogout');

                                            RequestUserLogout.addEventListener('click', function() {

                                                Swal.fire({

                                                    title: 'Logout Confirmation',
                                                    text: 'Are you sure you want to logout?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Yes, logout',
                                                    cancelButtonText: 'Cancel'

                                                }).then((result) => {

                                                    if (result.isConfirmed){

                                                        fetch('assets/main/php/Session_Logout.php', {
                                                            method: 'POST',
                                                        }).then(respond => {

                                                            if(respond.ok){

                                                                Swal.fire({
                    
                                                                    title:  'Logouts Successfully',
                                                                    icon:   'success',
                                                                    confirmButtonText:  'Okay'
                                                                
                                                                }).then((result) => {
                                                                    
                                                                    if(result.isConfirmed){

                                                                        window.location.href = 'Login.php';
                                                                    }
                                                                });
                                                            }
                                                        }).catch(error => {
                                                            
                                                            console.error('Error:', error);
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                ";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="index.php"><img src="assets/main/images/logo-title.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li class="active"><a href="Shop.php?fShopSearchHolder=&fRequestShopSearch=true">Products</a></li>
                            <li><a href="Contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="Cart.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="cart-count">0</span>
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">Item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Quick Access</span>
                        </div>
                        <ul>
                            

                            
                            <?php
                                include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                $CATEGORIES = "

                                    SELECT * FROM Categories
                                ";

                                $LIST_CATEGORIES_STMT = $dbHandler -> prepare($CATEGORIES);
                                
                                if($LIST_CATEGORIES_STMT -> execute()){

                                    while($availableCategories = $LIST_CATEGORIES_STMT -> fetch()){

                                        echo "<li><a href=\"Shop.php?fShopSearchCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
                                    }
                                }
                            ?>



                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">

                            <form name="ShopSearchForm" action="Shop.php" method="get">

                                <input name="fShopSearchHolder" type="text" placeholder="What's your jam?">
                                <button name="fRequestShopSearch" value="true" type="submit" class="site-btn">SEARCH</button>
                            </form>


                            <!-- Shop / Search -->
                            <?php
                                include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                $display_records = 0;

                                $PAGINATION_TABLE = "";

                                $PAGINATION_ARGS =
                                [
                                    "MAX_RECS_PERPAGE"  => 9,
                                    "START_POS"         => 0,
                                    "TOTAL_RECS"        => 0,
                                    "TOTAL_PAGES"       => 0
                                ];

                                if(($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET['fRequestShopSearch']) && ($_GET['fRequestShopSearch']) && isset($_GET["fShopSearchHolder"])){

                                    $bSearchHolder = "%" . ($_GET["fShopSearchHolder"] ?? "") . "%";

                                    $LISTING_TABLE =
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
                                        
                                    ";

                                    $PAGINATION_TABLE =
                                    "
                                        SELECT
                                            COUNT(*)
                                        FROM
                                            `Products` P
                                        JOIN
                                            `Categories` C
                                        ON
                                            C.CategoryID = P.CategoryID
                                    ";

                                    if (!empty($bSearchHolder)){ // if search holder is not empty, append the search target.

                                        $LISTING_TABLE .=
                                        "   
                                            WHERE
                                            (
                                                C.Name            LIKE :SearchTerm
                                                OR
                                                P.Name            LIKE :SearchTerm
                                            )
                                        ";

                                        $PAGINATION_TABLE .=
                                        "   
                                            WHERE
                                            (
                                                C.Name            LIKE :SearchTerm
                                                OR
                                                P.Name            LIKE :SearchTerm
                                            )
                                        ";
                                    }

                                    {// Limiting Recs on page
                                        $LISTING_TABLE .=
                                        '
                                            LIMIT
                                                :START_POS, :MAX_RECS_PERPAGE
                                        ';
                                    }

                                    $SEARCH_STMT            = $dbHandler -> prepare($LISTING_TABLE);
                                    $SEARCH_PAGINATION_STMT = $dbHandler -> prepare($PAGINATION_TABLE);

                                    if(!empty($bSearchHolder))
                                    {
                                        $SEARCH_STMT            -> bindParam(":SearchTerm", $bSearchHolder);
                                        $SEARCH_PAGINATION_STMT -> bindParam(":SearchTerm", $bSearchHolder);
                                    }
                                }else{

                                    $LISTING_TABLE = 
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
                                        LIMIT
                                            :START_POS, :MAX_RECS_PERPAGE
                                    ";

                                    $PAGINATION_TABLE =
                                    "
                                        SELECT
                                            COUNT(*)
                                        FROM
                                            `Products` P
                                        JOIN
                                            `Categories` C
                                        ON
                                            C.CategoryID = P.CategoryID 
                                    ";

                                    $SEARCH_STMT            = $dbHandler -> prepare($LISTING_TABLE);
                                    $SEARCH_PAGINATION_STMT = $dbHandler -> prepare($PAGINATION_TABLE);
                                }
                            ?>



                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+886 &nbsp; 0912345678</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Catagories</h4>
                            <ul>


                                <!-- Shop / Side Panel Categories -->
                                <?php
                                    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                    $CATEGORIES = "

                                        SELECT * FROM Categories
                                    ";

                                    $LIST_CATEGORIES_STMT = $dbHandler -> prepare($CATEGORIES);
                                    
                                    if($LIST_CATEGORIES_STMT -> execute()){

                                        while($availableCategories = $LIST_CATEGORIES_STMT -> fetch()){

                                            echo "<li><a href=\"Shop.php?CurrentPageIndex=1&fShopSearchCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
                                        }
                                    }
                                ?>
                                
                                <!-- Shop / Categories Search -->
                                <?php
                                    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                    if(isset($_GET["fShopSearchCategoryID"]) && ($_GET["fShopSearchCategoryID"])){

                                        $bSidePanelCategoryID = (int)($_GET["fShopSearchCategoryID"] ?? "");

                                        $SEARCH_ON_CATEGORIES = "

                                            SELECT * FROM Products
                                            WHERE CategoryID = :CategoryID
                                            LIMIT :START_POS, :MAX_RECS_PERPAGE
                                        ";

                                        $PAGINATION_ON_CATEGORIES = "

                                            SELECT COUNT(*) FROM Products
                                            WHERE CategoryID = :CategoryID
                                        ";

                                        $CATEGORY_SEARCH_STMT = $dbHandler -> prepare($SEARCH_ON_CATEGORIES);
                                        $CATEGORY_SEARCH_STMT-> bindParam(":CategoryID", $bSidePanelCategoryID, PDO::PARAM_INT);

                                        $CATEGORY_PAGINATION_STMT = $dbHandler -> prepare($PAGINATION_ON_CATEGORIES);
                                        $CATEGORY_PAGINATION_STMT-> bindParam(":CategoryID", $bSidePanelCategoryID, PDO::PARAM_INT);
                                    }
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
                


                <div class="col-lg-9 col-md-7">

                    <!-- Shop / Products Grids with Add Cart and More Details -->
                    <div class="row">
                        <?php // Product Rendering FROM SearchHolder
                            if(isset($_GET["CurrentPageIndex"]) && ($_GET["CurrentPageIndex"])){

                                $CurrentPage = (((int)$_GET["CurrentPageIndex"] - 1) > 0) ? (int)$_GET["CurrentPageIndex"] - 1: 0;

                                $PAGINATION_ARGS["START_POS"] = $CurrentPage * $PAGINATION_ARGS["MAX_RECS_PERPAGE"];
                            }
                            
                            // IF PRESS SEARCH ON THE SIDE PANEL
                            if(isset($_GET["fShopSearchCategoryID"])){
                                
                                // IF PRESS CATEGORIES ON THE SIDE PANEL
                                $CATEGORY_SEARCH_STMT -> bindParam(':START_POS',        $PAGINATION_ARGS["START_POS"],          PDO::PARAM_INT);
                                $CATEGORY_SEARCH_STMT -> bindParam(':MAX_RECS_PERPAGE', $PAGINATION_ARGS["MAX_RECS_PERPAGE"],   PDO::PARAM_INT);
                            }

                            $SEARCH_STMT -> bindParam(':START_POS',        $PAGINATION_ARGS["START_POS"],          PDO::PARAM_INT);
                            $SEARCH_STMT -> bindParam(':MAX_RECS_PERPAGE', $PAGINATION_ARGS["MAX_RECS_PERPAGE"],   PDO::PARAM_INT);
                            
                            if(($SEARCH_STMT -> execute()) && isset($_GET['fRequestShopSearch'])){
                                
                                $SEARCH_PAGINATION_STMT -> execute();

                                while($_RECS_ = $SEARCH_STMT -> fetch(PDO::FETCH_ASSOC)){

                                    echo 
                                    "
                                        <div class=\"col-lg-4 col-md-6 col-sm-6\">
                                            <div class=\"product__item\">

                                                <div class=\"product__item__pic\">
                                                    
                                                    <img class=\"setbg\" src='data:image/jpeg;base64,".base64_encode($_RECS_['Image'])."' alt='Product Image'>
                                                    
                                                    <form action=\"assets/main/php/Store_AddToCart.php\" method=\"post\" class=\"product__item__pic__hover\">
                                                        <input name='fAddProductID' type='hidden' value='{$_RECS_["ProductID"]}'>
                                                        <input name='fAddProductQuantity' type='hidden' value='1'>
                                                        <input name='fAddProductPrice' type='hidden' value='{$_RECS_["Price"]}'>

                                                        <button name='fRequestAddToCart' value='true'><i class=\"fa fa-shopping-cart\"></i></button>  
                                                    </form>
                                                
                                                </div>

                                                <div class=\"product__item__text\">
                                                    <h6><a href=\"ItemDetail.php?ProductID={$_RECS_["ProductID"]}\">{$_RECS_["Name"]}</a></h6> <!-- Product Name -->
                                                    <h5>\${$_RECS_["Price"]}</h5>
                                                </div>

                                            </div>
                                        </div>
                                    ";
                                }
                            }

                            else if(($CATEGORY_SEARCH_STMT -> execute() !== false) && isset($_GET["fShopSearchCategoryID"])){

                                $CATEGORY_PAGINATION_STMT -> execute();

                                while($_RECS_ = $CATEGORY_SEARCH_STMT -> fetch(PDO::FETCH_ASSOC)){

                                    echo 
                                    "
                                        <div class=\"col-lg-4 col-md-6 col-sm-6\">
                                            <div class=\"product__item\">

                                                <div class=\"product__item__pic\">
                                                    <img class=\"setbg\" src='data:image/jpeg;base64,".base64_encode($_RECS_['Image'])."' alt='Product Image'>
                                                    
                                                    <form action=\"Shop.php\" method=\"post\" class=\"product__item__pic__hover\">
                                                        <input name='fAddProductID' type='hidden' value='{$_RECS_["ProductID"]}'>
                                                        <input name='fAddProductQuantity' type='hidden' value='1'>
                                                        <input name='fAddProductPrice' type='hidden' value='{$_RECS_["Price"]}'>

                                                        <button name='fRequestAddToCart' value='true'><i class=\"fa fa-shopping-cart\"></i></button>  
                                                    </form>
                                                    
                                                </div>

                                                <div class=\"product__item__text\">
                                                    <h6><a href=\"ItemDetail.php?ProductID={$_RECS_["ProductID"]}\">{$_RECS_["Name"]}</a></h6> <!-- Product Name -->
                                                    <h5>\${$_RECS_["Price"]}</h5>
                                                </div>

                                            </div>
                                        </div>
                                    ";
                                }
                            }
                        ?>

                        <!-- Shop / Add Product to Cart Functionality -->
                        <?php
                            if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fRequestAddToCart"]) && ($_POST["fRequestAddToCart"])){

                                Session_CheckAuthLevel("USER", "Login.php");

                                if(isset($_POST["fAddProductID"]) && ($_POST["fAddProductID"]) && isset($_POST["fAddProductQuantity"]) && ($_POST["fAddProductQuantity"])){
                                
                                    $CHECK_IF_PRODUCT_IS_INCART = "

                                        SELECT COUNT(1) FROM Cart WHERE Product = :ProductID LIMIT 1
                                    ";

                                    $bTargetProduct = $_POST["fAddProductID"];
                                    $CHECKER_STMT = $dbHandler -> prepare($CHECK_IF_PRODUCT_IS_INCART);
                                    $CHECKER_STMT-> bindParam(":ProductID", $bTargetProduct, PDO::PARAM_INT);
                                    $CHECKER_STMT-> execute();

                                    if($CHECKER_STMT-> fetchColumn() !== 0){

                                        $INSERT_TO_CART = "
                                            INSERT INTO Cart ( CustomerID,  ProductID,  Quantity,  PayAmount) 
                                                             VALUES
                                                             (:CustomerID, :ProductID, :Quantity, :PayAmount)
                                        ";

                                        $bCustomerID        = $_SESSION["UserID"]           ?? "";
                                        $bProductID         = $_POST["fAddProductID"]       ?? "";
                                        $bProductQuantity   = $_POST["fAddProductQuantity"] ?? 1;
                                        $bProductPrice      = $_POST["fAddProductPrice"]    ?? "";
                                        
                                        $bProductPayAmount  = $bProductPrice * $bProductQuantity;

                                        $ADDCART_STMT = $dbHandler -> prepare($INSERT_TO_CART);
                                        $ADDCART_STMT-> bindParam(":CustomerID",  $bCustomerID,         PDO::PARAM_STR);
                                        $ADDCART_STMT-> bindParam(":ProductID",   $bProductID,          PDO::PARAM_INT);
                                        $ADDCART_STMT-> bindParam(":Quantity",    $bProductQuantity,    PDO::PARAM_INT);
                                        $ADDCART_STMT-> bindParam(":PayAmount",   $bProductPayAmount,   PDO::PARAM_INT);

                                        try{
                                        
                                            if($ADDCART_STMT -> execute()){

                                                echo
                                                "
                                                    <script>
                                                        alert(\"Product Successfullt Added.\");
                                                        window.location.href = \"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
                                                    </script>
                                                ";
                                            }

                                        }catch(PDOException $ERR){
                                        
                                            echo "DATABASE ERROR:" . $ERR -> getMessage();
                                        }
                                    }else{

                                        echo"

                                            <script>
                                                alert(\"The Product is already in the shopping cart.\");
                                            </script>                                       
                                        ";
                                    }

                                }
                            }
                        ?>
                    </div>


                    <!-- Shop / Pagination -->
                    <div class="product__pagination">
                        <?php
                            
                            $LISTING_PRESERVED = $_GET;
                            unset($LISTING_PRESERVED['CurrentPageIndex']);
                            if(isset($_GET['fRequestShopSearch']) && ($_GET['fRequestShopSearch']) && isset($_GET["fShopSearchHolder"])){

                                if(isset($_GET['fRequestShopSearch']) && ($_GET['fRequestShopSearch'])){

                                    unset($LISTING_PRESERVED['fShopSearchCategoryID']);
                                }
                            }else if(isset($_GET['fRequestShopSearch']) && ($_GET['fRequestShopSearch'])){
                            
                                if(isset($_GET['fRequestShopSearch']) && ($_GET['fRequestShopSearch']) && isset($_GET["fShopSearchHolder"])){
                                
                                    unset($LISTING_PRESERVED['fRequestShopSearch']);
                                    unset($LISTING_PRESERVED['fShopSearchHolder']);
                                }
                            }
                            $LISTING_PRESERVED = http_build_query($LISTING_PRESERVED);

                            $PAGINATION_ARGS["TOTAL_RECS"]  = $SEARCH_PAGINATION_STMT -> fetchColumn();
                            $display_records = $PAGINATION_ARGS["TOTAL_RECS"];
                            $PAGINATION_ARGS["TOTAL_PAGES"] = ceil($PAGINATION_ARGS["TOTAL_RECS"] / $PAGINATION_ARGS["MAX_RECS_PERPAGE"]);


                            // Previous
                            if(isset($_GET["CurrentPageIndex"]) && ($_GET["CurrentPageIndex"] > 1)){

                                $tmp = (int)$_GET["CurrentPageIndex"] - 1;

                                echo 
                                "
                                    <a href=\"?CurrentPageIndex={$tmp}&{$LISTING_PRESERVED}\">
                                        <i class=\"fa fa-long-arrow-left\"></i>
                                    </a>
                                ";
                            }

                            // Pages
                            for($i = 1; $i <= $PAGINATION_ARGS["TOTAL_PAGES"]; $i++){

                                echo "<a href=\"?CurrentPageIndex={$i}&{$LISTING_PRESERVED}\">$i</a>";
                            }

                            // Next
                            if(isset($_GET["CurrentPageIndex"]) && ((int)$_GET["CurrentPageIndex"] < $PAGINATION_ARGS["TOTAL_PAGES"])){

                                $tmp = (int)$_GET["CurrentPageIndex"] + 1;

                                echo 
                                "
                                    <a href=\"?CurrentPageIndex={$tmp}&{$LISTING_PRESERVED}\">
                                        <i class=\"fa fa-long-arrow-right\"></i>
                                    </a>
                                ";
                            }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="index.php"><img src="assets/main/images/logo-title.svg" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: National Pingtung University</li>
                            <li>Phone: +886 &nbsp; 0912345678</li>
                            <li>Email: dennisbrown12345@email.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="assets/main/images/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="assets/main/js/jquery-3.3.1.min.js"></script>
    <script src="assets/main/js/bootstrap.min.js"></script>
    <script src="assets/main/js/jquery.nice-select.min.js"></script>
    <script src="assets/main/js/jquery-ui.min.js"></script>
    <script src="assets/main/js/jquery.slicknav.js"></script>
    <script src="assets/main/js/mixitup.min.js"></script>
    <script src="assets/main/js/owl.carousel.min.js"></script>
    <script src="assets/main/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
        
            function updateCartCount() {
                $.ajax({
                    url: 'assets/main/php/Store_Cart_CountCart.php', // A PHP file to get the current cart count
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response);
                    }
                });
            }
            
            updateCartCount();
        });
    </script>
</body>

</html>